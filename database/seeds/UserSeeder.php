<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            "name"      => "admin",
            "email"     => "admin@admin.com",
            "password"  => bcrypt("password")
        ]);
    }
}
