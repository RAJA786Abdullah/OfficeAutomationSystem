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
            ['moduleID' => 6, 'moduleCode' => 'DASHBOARD', 'moduleName' => 'Dashboard Module']
        ];
	    foreach ($aryModules as $module) {
		    DB::table('modules')->insert(['moduleCode' => $module['moduleCode'],'moduleName' => $module['moduleName'],'moduleID' => $module['moduleID']]);
	    }
    }
}
