<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $aryUserRoles = [
            ['userID' => '1','roleID' => '1'],
            ['userID' => '2','roleID' => '2'],
            ['userID' => '3','roleID' => '4'],
            ['userID' => '4','roleID' => '5'],
            ['userID' => '5','roleID' => '6'],
            ['userID' => '9','roleID' => '7'],
            ['userID' => '8','roleID' => '8'],
            ['userID' => '7','roleID' => '9'],
            ['userID' => '6','roleID' => '11']
        ];

	    foreach ($aryUserRoles as $userRole) {
		    \Illuminate\Support\Facades\DB::table('userRole')->insert(['roleID' => $userRole['roleID'],'userID' => $userRole['userID']]);
	    }
    }
}
