<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'statusID' => 1,
            'department_id' => 1,
            'branch_id' => 1,
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);
    }
}
