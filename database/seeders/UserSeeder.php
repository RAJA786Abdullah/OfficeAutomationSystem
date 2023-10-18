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
            ['userID' => '1','name' => 'Admin','email' => 'admin','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => NULL],
            ['userID' => '2','name' => 'Imran Qureshi','email' => 'imran','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'Lt Col'],
            ['userID' => '3','name' => 'Adnan Chaudhry','email' => 'adnan','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '4','name' => 'Abdullah','email' => 'abdullah','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '5','name' => 'Umar Khan','email' => 'umar','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '6','name' => 'Kashif','email' => 'kashif','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '7','name' => 'Khuram','email' => 'khuram','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '8','name' => 'Wahab','email' => 'wahab','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '9','name' => 'Rahim','email' => 'rahim','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => \Illuminate\Support\Facades\Hash::make('admin123'),'department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil']
        ];
        foreach ($aryUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'status' => $user['status'],
                'department_id' => $user['department_id'],
                'branch_id' => $user['branch_id'],
                'is_signing_authority' => $user['is_signing_authority'],
                'arm_designation' => $user['arm_designation'],
                'password' => $user['password'],
            ]);
        }
    }
}
