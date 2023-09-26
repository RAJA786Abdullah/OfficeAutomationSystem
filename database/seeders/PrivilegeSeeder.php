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
            ['moduleID' => 6, 'accessLevelID' => 4, 'privilegeCode' => 'DASHBOARD','privilegeName' => 'Dashboard Delete'],

            ['moduleID' => 7, 'accessLevelID' => 1, 'privilegeCode' => 'BRANCH','privilegeName' => 'Branch Create'],
            ['moduleID' => 7, 'accessLevelID' => 2, 'privilegeCode' => 'BRANCH','privilegeName' => 'Branch Read'],
            ['moduleID' => 7, 'accessLevelID' => 3, 'privilegeCode' => 'BRANCH','privilegeName' => 'Branch Update'],
            ['moduleID' => 7, 'accessLevelID' => 4, 'privilegeCode' => 'BRANCH','privilegeName' => 'Branch Delete'],

            ['moduleID' => 8, 'accessLevelID' => 1, 'privilegeCode' => 'DEPARTMENT','privilegeName' => 'Department Create'],
            ['moduleID' => 8, 'accessLevelID' => 2, 'privilegeCode' => 'DEPARTMENT','privilegeName' => 'Department Read'],
            ['moduleID' => 8, 'accessLevelID' => 3, 'privilegeCode' => 'DEPARTMENT','privilegeName' => 'Department Update'],
            ['moduleID' => 8, 'accessLevelID' => 4, 'privilegeCode' => 'DEPARTMENT','privilegeName' => 'Department Delete'],

            ['moduleID' => 9, 'accessLevelID' => 1, 'privilegeCode' => 'FILES','privilegeName' => 'Files Create'],
            ['moduleID' => 9, 'accessLevelID' => 2, 'privilegeCode' => 'FILES','privilegeName' => 'Files Read'],
            ['moduleID' => 9, 'accessLevelID' => 3, 'privilegeCode' => 'FILES','privilegeName' => 'Files Update'],
            ['moduleID' => 9, 'accessLevelID' => 4, 'privilegeCode' => 'FILES','privilegeName' => 'Files Delete'],

            ['moduleID' => 10, 'accessLevelID' => 1, 'privilegeCode' => 'CLASSIFICATION','privilegeName' => 'Classification Create'],
            ['moduleID' => 10, 'accessLevelID' => 2, 'privilegeCode' => 'CLASSIFICATION','privilegeName' => 'Classification Read'],
            ['moduleID' => 10, 'accessLevelID' => 3, 'privilegeCode' => 'CLASSIFICATION','privilegeName' => 'Classification Update'],
            ['moduleID' => 10, 'accessLevelID' => 4, 'privilegeCode' => 'CLASSIFICATION','privilegeName' => 'Classification Delete'],

            ['moduleID' => 11, 'accessLevelID' => 1, 'privilegeCode' => 'DOCUMENT_TYPE','privilegeName' => 'Document Type Create'],
            ['moduleID' => 11, 'accessLevelID' => 2, 'privilegeCode' => 'DOCUMENT_TYPE','privilegeName' => 'Document Type Read'],
            ['moduleID' => 11, 'accessLevelID' => 3, 'privilegeCode' => 'DOCUMENT_TYPE','privilegeName' => 'Document Type Update'],
            ['moduleID' => 11, 'accessLevelID' => 4, 'privilegeCode' => 'DOCUMENT_TYPE','privilegeName' => 'Document Type Delete'],

            ['moduleID' => 12, 'accessLevelID' => 1, 'privilegeCode' => 'DOCUMENTS','privilegeName' => 'Documents Create'],
            ['moduleID' => 12, 'accessLevelID' => 2, 'privilegeCode' => 'DOCUMENTS','privilegeName' => 'Documents Read'],
            ['moduleID' => 12, 'accessLevelID' => 3, 'privilegeCode' => 'DOCUMENTS','privilegeName' => 'Documents Update'],
            ['moduleID' => 12, 'accessLevelID' => 4, 'privilegeCode' => 'DOCUMENTS','privilegeName' => 'Documents Delete'],

            ['moduleID' => 13, 'accessLevelID' => 1, 'privilegeCode' => 'REMARKS','privilegeName' => 'Remarks Create'],
            ['moduleID' => 13, 'accessLevelID' => 2, 'privilegeCode' => 'REMARKS','privilegeName' => 'Remarks Read'],
            ['moduleID' => 13, 'accessLevelID' => 3, 'privilegeCode' => 'REMARKS','privilegeName' => 'Remarks Update'],
            ['moduleID' => 13, 'accessLevelID' => 4, 'privilegeCode' => 'REMARKS','privilegeName' => 'Remarks Delete'],

            ['moduleID' => 14, 'accessLevelID' => 1, 'privilegeCode' => 'ATTACHMENTS','privilegeName' => 'Attachments Create'],
            ['moduleID' => 14, 'accessLevelID' => 2, 'privilegeCode' => 'ATTACHMENTS','privilegeName' => 'Attachments Read'],
            ['moduleID' => 14, 'accessLevelID' => 3, 'privilegeCode' => 'ATTACHMENTS','privilegeName' => 'Attachments Update'],
            ['moduleID' => 14, 'accessLevelID' => 4, 'privilegeCode' => 'ATTACHMENTS','privilegeName' => 'Attachments Delete'],

            ['moduleID' => 15, 'accessLevelID' => 1, 'privilegeCode' => 'RECIPIENTS','privilegeName' => 'Recipients Create'],
            ['moduleID' => 15, 'accessLevelID' => 2, 'privilegeCode' => 'RECIPIENTS','privilegeName' => 'Recipients Read'],
            ['moduleID' => 15, 'accessLevelID' => 3, 'privilegeCode' => 'RECIPIENTS','privilegeName' => 'Recipients Update'],
            ['moduleID' => 15, 'accessLevelID' => 4, 'privilegeCode' => 'RECIPIENTS','privilegeName' => 'Recipients Delete'],

            ['moduleID' => 16, 'accessLevelID' => 1, 'privilegeCode' => 'FRONT','privilegeName' => 'Front Create'],
            ['moduleID' => 16, 'accessLevelID' => 2, 'privilegeCode' => 'FRONT','privilegeName' => 'Front Read'],
            ['moduleID' => 16, 'accessLevelID' => 3, 'privilegeCode' => 'FRONT','privilegeName' => 'Front Update'],
            ['moduleID' => 16, 'accessLevelID' => 4, 'privilegeCode' => 'FRONT','privilegeName' => 'Front Delete'],

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
