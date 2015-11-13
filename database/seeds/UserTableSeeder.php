<?php
use App\User;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->ip = "192.168.56.100";
        $user->email = "admin@email.be";
        $user->name = "mister";
        $user->surname = "admin";
        $user->password = Hash::make('root1234');
        $user->isAdmin = true;
        $user->is_facebook = false;

       	$user->save();
    }
}
