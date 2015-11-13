<?php
use App\Competitor;

use Illuminate\Database\Seeder;

class CompetitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competitor = new Competitor;

        $competitor->picture_url = "/img/competition/test-duvel.jpg";
        $competitor->ip = "192.168.56.100";
        $competitor->thumbnail = "img/competition/test-duvel.jpg";
        $competitor->user_id = 1;
        $competitor->is_deleted = 0;

        $competitor->save();
    }
}
