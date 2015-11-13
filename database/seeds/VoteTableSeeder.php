<?php
use App\Vote;

use Illuminate\Database\Seeder;

class VoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vote = new Vote;

        $vote->ip = "192.168.56.100";
        $vote->competitors()->associate(1);
        // $vote->users()->associate(1);

        $vote->save();

    }
}
