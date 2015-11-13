<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        // $this->command->info('Seeded the users table');
        // $this->call(CompetitorTableSeeder::class);
        // $this->command->info('seeded the competitors table');
        // $this->call(VoteTableSeeder::class);
        $this->call(DateTableSeeder::class);
        $this->command->info('seeded all tables');
        Model::reguard();
    }
}
