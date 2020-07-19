<?php

use Illuminate\Database\Seeder;
use  App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!count(User::get())) {
            $user = new User();
            $user->name = "Admin";
            $user->email = "admin@admin.az";
            $user->password = \Illuminate\Support\Facades\Hash::make(12345);
            $user->save();
        }
    }
}
