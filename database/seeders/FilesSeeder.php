<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryBranches = [
            ['name' => 'IT',      'code' => '101'],
            ['name' => 'T&R',     'code' => '102'],
            ['name' => 'HR',      'code' => '103'],
            ['name' => 'Security','code' => '104']
        ];
        foreach ($aryBranches as $branch) {
            DB::table('files')->insert(['name' => $branch['name'],'code'=>$branch['code']]);
        }
    }
}
