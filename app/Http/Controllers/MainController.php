<?php
//cloud9 of heroku

namespace App\Http\Controllers;

use App\User;
use App\Competitor;
use App\Vote;
use App\Winner;
use App\Date;
use Input;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Validator;
use Carbon\Carbon;

class MainController extends Controller
{
    public function home()
    {
        $winners    = Winner::take(4)->get();
        $data       = array('winners' => $winners);

        return View('welcome')->with($data);
    }

    public function competition()
    {
    	$users         = User::all();
    	$competitors   = Competitor::all();
    	$data          = ['competitors' => $competitors];
    	
    	return View('competition.competition')->with($data);

    }

    protected function competitionRules()
    {

    }

    public function postCompetition(Request $request)
    {
        $thisDate           = Date::where('endDate', '>', Carbon::now())->where('startDate', '<=', Carbon::now())->first();
        $thisCompetitions   = Auth::user()->competitors;
        $hasParticipated    = false;
        foreach($thisCompetitions as $thisCompetition)
        {
            if($thisCompetition->created_at >= $thisDate->startDate)
            {
                $hasParticipated = true;
                var_dump('participated: ' . $thisCompetition);
            }
        }
        if(!$hasParticipated)
        {
            $validator = Validator::make($request->all(), [
                        'duvel' => 'required|image|mimes:jpeg',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            //check if image is valid
            if( $request->file('duvel')->isValid()  )
            {

                $destinationPath   = "img/competition/";
                $extension         = $request->file('duvel')->getClientOriginalExtension();
                $fileName          = rand(11111,99999).'.'.$extension; // renameing image random name
                //fullpath = path to picture + filename + extension
                $fullPath          = $destinationPath . $fileName;   

                $pic = $request->file('duvel');

                //make a thumbnail for the same pic with a height of 100
                $picSize            = getimagesize($pic);
                $width              = $picSize[0];
                $height             = $picSize[1];
                $newHeight          = 100;
                //change the width depending on the height of the pic
                $newWidth           = $newHeight * ($width/$height);
                $image              = imagecreatefromjpeg($pic);
                $thumbnail          = imagecreatetruecolor($newWidth, $newHeight);
                //make the pic ($image) smaller and move it to $thumbnail
                $newImage           = imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                //the path where to put the thumbnail
                $thumbnailPath      = $destinationPath . 'thumbnail/' . $fileName;
                imagejpeg($thumbnail, $thumbnailPath);
                // uploading file to given path
                $pic->move($destinationPath , $fileName); 
                //make the competitor object for the database
                $competitor                 = new Competitor;

                $competitor->picture_url    = '/' . $fullPath;
                $competitor->thumbnail      = '/' . $thumbnailPath;
                $competitor->user_id        = Auth::user()->id;
                $competitor->ip             = $request->getClientIp();
                $competitor->is_deleted     = 0;

                $competitor->save();

                return redirect()->route('otherCompetitors')->withErrors(["you've succesfully uploaded your picture. cheers!"]);


            }
            else
            {
                return redirect()->back()->withErrors('the image is not valid.');
            }
        } else
        {
            return redirect()->route('otherCompetitors')->withErrors('you have already participated in our competition');
        }
     
    }

    public function competitor($id)
    {
    	$competitor = Competitor::findOrFail($id);

    	// var_dump($competitor);
    	$data = array('competitor' => $competitor);
    	return view('competition.competitor')->with($data);
    }

    public function vote($id, Request $request)
    {
        $request->setTrustedProxies(array('192.0.0.1', '10.0.0.0/8'));
        $competitor = Competitor::findOrFail($id);
        //check if there is no vote for this particular competitor on current ip adress
        if(!Vote::where('ip', '=', $request->getClientIp())->where('competitor_id', '=', $id)->exists())
        {
            echo 'nice';
            $vote = new Vote;
    		$vote->ip = $request->getClientIp();
    		$vote->competitor_id = $id;

    		$vote->save();

    		return redirect()->route('otherCompetitors');
    	}

    	return redirect()->back()->withErrors(['you have already voted for this competitor.']);
    }

    public function unVote($id, Request $request)
    {
        $votes = Competitor::findOrFail($id)->votes;
        $request->setTrustedProxies(array('192.0.0.1', '10.0.0.0/8'));
        foreach($votes as $vote)
        {
            //if your ip is the same as the one of the voter => unvote
            if($vote->ip == $request->getClientIp())
            {
                $vote->delete();
                return 'unvoted succesfully';
            }
        }
        return "can't unvote this picture";
    }

    public function otherCompetitors(Request $request)
    {
        $thisDate = Date::where('endDate', '>', Carbon::now())->where('startDate', '<=', Carbon::now())->first();
        $competitors = Competitor::where('created_at', '>', $thisDate->startDate)->orderby('created_at', 'DESC')->paginate(12)  ;
        $request->setTrustedProxies(array('192.0.0.1', '10.0.0.0/8'));
        foreach ($competitors as $competitor) {
            $competitor->voted = false;
            foreach ($competitor->votes as $vote) {
                //check if you already have voted for this competitor
                if($vote->ip == $request->getClientIp())
                {
                    //give your object 
                    $competitor->voted = true;
                }
            }
        }

        $data = ['competitors' => $competitors];

        return View('competition.otherCompetitors')->with($data);
    }

    public function test()
    {
        $thisDate = Date::where('endDate', '<', Carbon::now())->orderby('endDate', 'DESC')->first();
        $competitors = Competitor::where('created_at', '>', $thisDate->startDate)->where('created_at', '<', $thisDate->endDate)->get();
        if (!count($thisDate->winner) && count($competitors))
        {
            // var_dump($competitors);

            $winner = $competitors->first();
            foreach($competitors as $competitor)
            {
                var_dump( $competitor->getTotalVotes() );
                echo '</br>';
                if($competitor->getTotalVotes() > $winner->getTotalVotes()){
                    $winner = $competitor;
                }

            }

            $newWinner = new Winner;

            $newWinner->competitor_id = $winner->id;
            $newWinner->date_id = $thisDate->id;

            $newWinner->save();
        }

        // $thisDate = Date::where('endDate', '<', Carbon::now())->orderby('endDate', 'DESC')->first();

        // var_dump($thisDate);
        // echo '</br>';

        // if (count($thisDate->winner))
        // {
        //     echo 'er is reeds een winnaar';
        // } else 
        // {
        //     echo 'er is nog geen winnaar';
        // }

    }

    public function postTest(Request $request)
    {
        $pic = Input::file('duvel');
        $picSize = getimagesize($pic);
        $width = $picSize[0];
        $height = $picSize[1];
        $newHeight = 100;
        $newWidth = $newHeight * ($width/$height);
        $image = imagecreatefromjpeg($pic);
        $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
        // var_dump($picSize);
        $heightFraction = $picSize[1]/$picSize[0];
        // echo $heightFraction;
        $newImage = imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        var_dump($thumbnail);

        imagejpeg($thumbnail, 'img/thumbnail/test.jpg');
        // imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    }

    public function testajax()
    {
        $user = Competitor::all();
        $vote = new Vote;

        $vote->ip = "lolz nope";
        $vote->competitor_id = $user->first()->id;

        $vote->save();

        return json_encode($user);
    }



    public function managment()
    {
        $competitors = Competitor::paginate(25);

        $data = ['competitors' => $competitors];

        return View('managment')->with($data);
    }

    public function exportAll()
    {
        $table = Competitor::all();
        $user = User::first();
        $makeKeys = $table;
        $output= "";
        $keyArray = [];
        foreach ($makeKeys->first()->toArray() as $key => $value) {
            // var_dump( $key );
                array_push($keyArray, $key);
            
        }
        // var_dump($table->first()->user->toArray());
        foreach ($user->toArray() as $key => $value) {
            if($key !== 'id')
            {
                array_push($keyArray, $key);
            }
        }
        // var_dump($table . '</br>');
        // var_dump($makeKeys);
        // var_dump( $keyArray );
        $output .= implode(",", $keyArray) ."\n";
        foreach ($table as $row) {
            // var_dump($row);echo'</br>';
            $output.=  implode(",",$row->toArray()); 
            $output.= implode(",",$row->user->toArray()) . "\n";
        }
        // echo $output;
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="allParticipants.csv"',
        );

        return Response::make(rtrim($output, "\n"), 200, $headers);
    }

    public function deleteCompetitor($id)
    {
        $competitor = Competitor::findOrFail($id);

        $competitor->is_deleted = abs($competitor->is_deleted - 1);
        $competitor->save();

        return redirect()->back();
    }
}

