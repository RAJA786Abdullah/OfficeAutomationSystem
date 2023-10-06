<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $aryUserRoles = [
            ['userID' => 1,'roleID' => 1],
//            ['userID' => 2,'roleID' => 6],
//
//            ['userID' => 3,'roleID' => 5],
//            ['userID' => 4,'roleID' => 7],
//
//            ['userID' => 5,'roleID' => 1],
//            ['userID' => 6,'roleID' => 4],
        ];

	    foreach ($aryUserRoles as $userRole) {
		    \Illuminate\Support\Facades\DB::table('userRole')->insert(['roleID' => $userRole['roleID'],'userID' => $userRole['userID']]);
	    }
    }
}
