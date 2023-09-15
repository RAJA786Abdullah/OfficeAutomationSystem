<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aryAccessLevels = [
            ['accessLevelID' => 1, 'accessLevel' => 'Create'],
            ['accessLevelID' => 2, 'accessLevel' => 'Read'],
            ['accessLevelID' => 3, 'accessLevel' => 'Update'],
            ['accessLevelID' => 4, 'accessLevel' => 'Delete']
        ];
	    foreach ($aryAccessLevels as $accessLevel) {
		    DB::table('accessLevel')->insert(['accessLevel' => $accessLevel['accessLevel'],'accessLevelID' => $accessLevel['accessLevelID']]);
	    }
    }
}
