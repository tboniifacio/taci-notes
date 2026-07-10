<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
    [
        'username'   => 'ana.souza@email.com',
        'password'   => bcrypt('123456'),
        'created_at' => now(),
    ],
    [
        'username'   => 'carlos.mendes@email.com',
        'password'   => bcrypt('123456'),
        'created_at' => now(),
    ],
    [
        'username'   => 'fernanda.lima@email.com',
        'password'   => bcrypt('123456'),
        'created_at' => now(),
    ],
     [
        'username'   => 'tacianebonii@gmail.com',
        'password'   => bcrypt('123456'),
        'created_at' => now(),
    ],
]);
    }
}