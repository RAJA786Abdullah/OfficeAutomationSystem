<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aryModules = [
            ['moduleID' => 1, 'moduleCode' => 'GENERAL','moduleName' => 'General Module'],
            ['moduleID' => 2, 'moduleCode' => 'SETTING','moduleName' => 'Setting Module'],
            ['moduleID' => 3, 'moduleCode' => 'USER', 'moduleName' => 'Users Module'],
            ['moduleID' => 4, 'moduleCode' => 'ROLES','moduleName' => 'Roles Module'],
            ['moduleID' => 5, 'moduleCode' => 'PAGES','moduleName' => 'Pages Module'],
            ['moduleID' => 6, 'moduleCode' => 'DASHBOARD', 'moduleName' => 'Dashboard Module'],
            ['moduleID' => 7, 'moduleCode' => 'BRANCH', 'moduleName' => 'Branch Module'],
            ['moduleID' => 8, 'moduleCode' => 'DEPARTMENT', 'moduleName' => 'Department Module'],
            ['moduleID' => 9, 'moduleCode' => 'FILES', 'moduleName' => 'Files Module'],
            ['moduleID' => 10, 'moduleCode' => 'CLASSIFICATION', 'moduleName' => 'Classification Module'],
            ['moduleID' => 11, 'moduleCode' => 'DOCUMENT_TYPE', 'moduleName' => 'Document Type Module'],
            ['moduleID' => 12, 'moduleCode' => 'DOCUMENTS', 'moduleName' => 'Documents Module'],
            ['moduleID' => 13, 'moduleCode' => 'REMARKS', 'moduleName' => 'Remarks Module'],
            ['moduleID' => 14, 'moduleCode' => 'ATTACHMENTS', 'moduleName' => 'Attachments Module'],
            ['moduleID' => 15, 'moduleCode' => 'RECIPIENTS', 'moduleName' => 'Recipients Module'],
//            ['moduleID' => 16, 'moduleCode' => 'FRONT', 'moduleName' => 'Front Module'],
        ];
	    foreach ($aryModules as $module) {
		    DB::table('modules')->insert(['moduleCode' => $module['moduleCode'],'moduleName' => $module['moduleName'],'moduleID' => $module['moduleID']]);
	    }
    }
}
