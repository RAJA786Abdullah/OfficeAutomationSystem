<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aryPrivileges = [
            ['moduleID' => 1, 'accessLevelID' => 1, 'privilegeCode' => 'GENERAL', 'privilegeName' => 'General Create'],
            ['moduleID' => 1, 'accessLevelID' => 2, 'privilegeCode' => 'GENERAL', 'privilegeName' => 'General Read'],
            ['moduleID' => 1, 'accessLevelID' => 3, 'privilegeCode' => 'GENERAL', 'privilegeName' => 'General Update'],
            ['moduleID' => 1, 'accessLevelID' => 4, 'privilegeCode' => 'GENERAL', 'privilegeName' => 'General Delete'],
            ['moduleID' => 2, 'accessLevelID' => 1, 'privilegeCode' => 'SETTING', 'privilegeName' => 'Setting Create'],
            ['moduleID' => 2, 'accessLevelID' => 2, 'privilegeCode' => 'SETTING', 'privilegeName' => 'Setting Read'],
            ['moduleID' => 2, 'accessLevelID' => 3, 'privilegeCode' => 'SETTING', 'privilegeName' => 'Setting Update'],
            ['moduleID' => 2, 'accessLevelID' => 4, 'privilegeCode' => 'SETTING', 'privilegeName' => 'Setting Delete'],
            ['moduleID' => 3, 'accessLevelID' => 1, 'privilegeCode' => 'USER', 'privilegeName' => 'Users Create'],
            ['moduleID' => 3, 'accessLevelID' => 2, 'privilegeCode' => 'USER', 'privilegeName' => 'Users Read'],
            ['moduleID' => 3, 'accessLevelID' => 3, 'privilegeCode' => 'USER', 'privilegeName' => 'Users Update'],
            ['moduleID' => 3, 'accessLevelID' => 4, 'privilegeCode' => 'USER', 'privilegeName' => 'Users Delete'],
            ['moduleID' => 4, 'accessLevelID' => 1, 'privilegeCode' => 'ROLES','privilegeName' => 'Roles Create'],
            ['moduleID' => 4, 'accessLevelID' => 2, 'privilegeCode' => 'ROLES','privilegeName' => 'Roles Read'],
            ['moduleID' => 4, 'accessLevelID' => 3, 'privilegeCode' => 'ROLES','privilegeName' => 'Roles Update'],
            ['moduleID' => 4, 'accessLevelID' => 4, 'privilegeCode' => 'ROLES','privilegeName' => 'Roles Delete'],
            ['moduleID' => 5, 'accessLevelID' => 1, 'privilegeCode' => 'PAGES','privilegeName' => 'Pages Create'],
            ['moduleID' => 5, 'accessLevelID' => 2, 'privilegeCode' => 'PAGES','privilegeName' => 'Pages Read'],
            ['moduleID' => 5, 'accessLevelID' => 3, 'privilegeCode' => 'PAGES','privilegeName' => 'Pages Update'],
            ['moduleID' => 5, 'accessLevelID' => 4, 'privilegeCode' => 'PAGES','privilegeName' => 'Pages Delete'],
            ['moduleID' => 6, 'accessLevelID' => 1, 'privilegeCode' => 'DASHBOARD','privilegeName' => 'Dashboard Create'],
            ['moduleID' => 6, 'accessLevelID' => 2, 'privilegeCode' => 'DASHBOARD','privilegeName' => 'Dashboard Read'],
            ['moduleID' => 6, 'accessLevelID' => 3, 'privilegeCode' => 'DASHBOARD','privilegeName' => 'Dashboard Update'],
            ['moduleID' => 6, 'accessLevelID' => 4, 'privilegeCode' => 'DASHBOARD','privilegeName' => 'Dashboard Delete']
            ];
	    foreach ($aryPrivileges as $privilege) {
		    DB::table('privilege')->insert(
			    [
				    'moduleID' => $privilege['moduleID'],
				    'accessLevelID' => $privilege['accessLevelID'],
				    'privilegeCode' => $privilege['privilegeCode'],
				    'privilegeName' => $privilege['privilegeName'],
			    ]
		    );
	    }
    }
}
