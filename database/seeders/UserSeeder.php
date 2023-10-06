<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    public function run()
    {

        $aryUsers = [
            ['name' => 'Admin', 'email' => 'admin', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=> \Illuminate\Support\Facades\Hash::make('admin123')],
            ['name' => 'Hameed', 'email' => 'hameed', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=>\Illuminate\Support\Facades\Hash::make('hameed123')],
            ['name' => 'Zain', 'email' => 'zain', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=>\Illuminate\Support\Facades\Hash::make('zain1234')],
            ['name' => 'Wahab', 'email' => 'wahab', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=>\Illuminate\Support\Facades\Hash::make('wahab123')],
            ['name' => 'asfand', 'email' => 'asfand', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=>\Illuminate\Support\Facades\Hash::make('asfand123')],
            ['name' => 'Abdullah', 'email' => 'abdullah', 'status' => 1,'department_id' => 1, 'branch_id'=> 1, 'password'=>\Illuminate\Support\Facades\Hash::make('abdullah123')]



        ];

        foreach ($aryUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'status' => $user['status'],
                'department_id' => $user['department_id'],
                'branch_id' => $user['branch_id'],
                'password' => $user['password'],

            ]);
        }


//        \Illuminate\Support\Facades\DB::table('users')->insert([
//            'name' => 'Super Admin',
//            'email' => 'admin1',
//            'status' => 1,
//            'department_id' => 1,
//            'branch_id' => 1,
//            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
//        ]);
//
//        \Illuminate\Support\Facades\DB::table('users')->insert([
//            'name' => 'User',
//            'email' => 'user1',
//            'status' => 1,
//            'department_id' => 1,
//            'branch_id' => 1,
//            'password' => \Illuminate\Support\Facades\Hash::make('user123'),
//        ]);
    }
}
