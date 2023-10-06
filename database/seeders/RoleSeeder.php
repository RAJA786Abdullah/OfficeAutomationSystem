<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aryRoles = [
            ['roleID' => 1, 'roleName' => 'Admin', 'description' => 'Role for Admin'],
//            ['roleID' => 2, 'roleName' => 'User', 'description' => 'Role for User'],
//
//            ['roleID' => 3, 'roleName' => 'Clark IT', 'description' => 'clark it'],
//            ['roleID' => 4, 'roleName' => 'Manager IT', 'description' => 'Manager it'],
//            ['roleID' => 5, 'roleName' => 'Assistant Director IT', 'description' => 'assistant director it'],
//            ['roleID' => 6, 'roleName' => 'Director IT', 'description' => 'director it'],
//
//            ['roleID' => 7, 'roleName' => 'Clark Land', 'description' => 'clark land'],
//            ['roleID' => 8, 'roleName' => 'Manager Land', 'description' => 'Manager land'],
//            ['roleID' => 9, 'roleName' => 'Assistant Director Land', 'description' => 'assistant director land'],
//            ['roleID' => 10, 'roleName' => 'Director Land', 'description' => 'director land'],


        ];

	    foreach ($aryRoles as $role) {
		    DB::table('roles')->insert([
			    'roleID' => $role['roleID'],
			    'roleName' => $role['roleName'],
			    'description' => $role['description']
		    ]);
	    }
    }
}
