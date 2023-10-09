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
            ['userID' => '1','name' => 'Admin','email' => 'admin','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$OSefiiwsNO20/61qW.L7xOwtaxqsj6/fZ5JkAnakXJTsHFwihSItu','department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => NULL],
            ['userID' => '2','name' => 'Imran Qureshi','email' => 'hameed','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$Bh51gNJB0h2/B6k/Wyg5R.F/fsQPSKVTv3r/4UVjxwjWpTznMfG7O','department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'Lt Col'],
            ['userID' => '3','name' => 'Adnan Chaudhry','email' => 'adnan','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$mrRwyKT5ajAnYAw4T4FFdeXNh3RzQOxE76z792UlUu4s4s.mnWSya','department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '4','name' => 'Abdullah','email' => 'abdullah','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$F96Nyw2ffsKJTyQYzI9WTu0t8kHH1FgTfHKfWQjYmcNYKSgZeBcDm','department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '5','name' => 'Umar Khan','email' => 'umarkhan','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$y/wYvzhGPHwa1FSp2opedep3GK/nJkzTYHy8K9NS688NhEBX.1bJW','department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '6','name' => 'Kashif','email' => 'kashif','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$pHr2X5LsxYd7o/olNnmPl.60BEBOpDP.Bdawbidk70m4MT31hqcQa','department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '7','name' => 'Khuram','email' => 'khuram','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$H/StYiSVX6gXePXvcIrTMuLeYKLu7/HLojUODqhRS.RbD/98/keyS','department_id' => '1','branch_id' => '1','is_signing_authority' => '1','arm_designation' => 'civil'],
            ['userID' => '8','name' => 'Wahab','email' => 'wahab','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$nmp7Wy8EMH4C0wKnlYXkXub3o5olkIiMOwjIwTK5vdWiv/YeJd8ru','department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil'],
            ['userID' => '9','name' => 'Rahim','email' => 'rahim','lastLogin' => NULL,'status' => '1','lastLoginIP' => NULL,'password' => '$2y$10$TfsGsNaH5G3Gofj3viYe0eFsiCu9lZS36mn/i6ZqvPIBpWjMEXZlO','department_id' => '1','branch_id' => '1','is_signing_authority' => '0','arm_designation' => 'civil']
        ];

        foreach ($aryUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'status' => $user['status'],
                'department_id' => $user['department_id'],
                'branch_id' => $user['branch_id'],
                'is_signing_authority' => $user['is_signing_authority'],
                'password' => $user['password'],
            ]);
        }
    }
}
