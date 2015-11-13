<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Competitor;
use App\Wedstrijd;
use App\Date;
use App\Winner;
use Carbon\Carbon;

class checkWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkWinner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // \Log::info('I was here @' . Carbon::now() );

        $thisDate = Date::where('endDate', '<', Carbon::now())->orderby('endDate', 'DESC')->first();
        $competitors = Competitor::where('created_at', '>', $thisDate->startDate)->where('created_at', '<', $thisDate->endDate)->where('is_deleted', '=', false)->get();
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

    }
}
