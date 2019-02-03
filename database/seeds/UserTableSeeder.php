<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

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
        $user->name = 'smile builders';
        $user->email = 'info@smilebuilders.net';
        $user->password = Hash::make('sm1l3s3cur3');
        $user->save();

        $user = new User;
        $user->name = 'i love my dentist';
        $user->email = 'info@ilovemydentist.com';
        $user->password = Hash::make('sm1l3s3cur3');
        $user->save();
    }
}
