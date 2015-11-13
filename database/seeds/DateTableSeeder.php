<?php

use Illuminate\Database\Seeder;

class DateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new App\Date;

        $date->startDate = new DateTime('10/23/2015');
        $date->endDate = new DateTime('10/31/2015');

        $date->save();

        $date = new App\Date;

        $date->startDate = new DateTime('10/31/2015');
        $date->endDate = new DateTime('11/08/2015');

        $date->save();

        $date = new App\Date;

        $date->startDate = new DateTime('11/08/2015');
        $date->endDate = new DateTime('11/15/2015');

        $date->save();

        $date = new App\Date;

        $date->startDate = new DateTime('11/15/2015');
        $date->endDate = new DateTime('11/23/2015');

        $date->save();


    }
}
