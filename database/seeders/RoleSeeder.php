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
            ['roleID' => 2, 'roleName' => 'User', 'description' => 'Role for User']
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
