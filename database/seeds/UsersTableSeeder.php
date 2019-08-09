<?php

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
            'username' => 'suretee',
            'fname' => 'Abu',
            'lname' => 'lawwy',
            'addr' => 'No 10',
            'role' => 'superadmin',
            'email' => Str::random(5) . 'gmail.com',
            'password' => bcrypt('abudhabi'),
        ]);

    }
}
