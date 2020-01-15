<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'superadmin',
            'fname' => 'Sure',
            'lname' => 'Tee',
            'addr' => 'No 10',
            'role' => 'superadmin',
            'email' => 'naijafixer112@gmail.com',
            'password' => bcrypt('abula112'),
            'sex' => 'male',
            'addr' => 'No 13',
            'num' => '08106813749',
            'so' => 'Ogun',
            'dob' => Carbon::createFromFormat('Y-m-d', '1990-08-16'),
        ]);

        DB::table('users')->insert([
            'username' => 'useradmin',
            'fname' => 'Abdullah',
            'lname' => 'lawwy',
            'addr' => 'No 10',
            'role' => 'admin',
            'email' => Str::random(5) . '@gmail.com',
            'type' => 'user',
            'password' => bcrypt('abula112'),
            'sex' => 'male',
            'addr' => 'No 13',
            'num' => '08106813749',
            'so' => 'Ogun',
            'dob' => Carbon::createFromFormat('Y-m-d', '1990-08-16'),
        ]);

        DB::table('users')->insert([
            'username' => 'companyadmin',
            'fname' => 'Abubakar',
            'lname' => 'lawwy',
            'addr' => 'No 10',
            'role' => 'admin',
            'email' => Str::random(5) . '@gmail.com',
            'type' => 'company',
            'password' => bcrypt('abula112'),
            'sex' => 'male',
            'addr' => 'No 13',
            'num' => '08106813749',
            'so' => 'Ogun',
            'dob' => Carbon::createFromFormat('Y-m-d', '1990-08-16'),
        ]);

        DB::table('users')->insert([
            'username' => 'user',
            'fname' => 'Habeeb Lawal',
            'lname' => 'lawwy',
            'addr' => 'No 10',
            'role' => 'user',
            'email' => 'abula3003@gmail.com',
            //'type' => 'user',
            'password' => bcrypt('abula112'),
            'sex' => 'male',
            'addr' => 'No 13',
            'num' => '08106813749',
            'so' => 'Ogun',
            'dob' => Carbon::createFromFormat('Y-m-d', '1990-08-16'),
        ]);

    }
}