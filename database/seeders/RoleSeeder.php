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
//            ['roleID' => 2, 'roleName' => 'Director IT', 'description' => 'Role for Director IT'],
//            ['roleID' => 3, 'roleName' => 'Deputy Director IT', 'description' => 'Role for Deputy Director IT'],
//            ['roleID' => 4, 'roleName' => 'Assistant Director IT', 'description' => 'Role for Assistant Director IT'],
//            ['roleID' => 5, 'roleName' => 'Manager IT', 'description' => 'Role for Manager IT'],
//            ['roleID' => 6, 'roleName' => 'Clerk IT', 'description' => 'Role for Clerk IT'],
//
//            ['roleID' => 7, 'roleName' => 'Clerk Legal', 'description' => 'Role for Clerk Legal'],
//            ['roleID' => 8, 'roleName' => 'Manager Legal', 'description' => 'Role for Manager Legal'],
//            ['roleID' => 9, 'roleName' => 'Assistant Director Legal', 'description' => 'Role for Assistant Director Legal'],
//            ['roleID' => 10, 'roleName' => 'Deputy Director Legal', 'description' => 'Role for Deputy Director Legal'],
//            ['roleID' => 11, 'roleName' => 'Director Legal', 'description' => 'Role for Director Legal'],
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
