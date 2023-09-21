<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['name' => 'IT',      'code' => '101', 'created_at' => Carbon::now()],
            ['name' => 'T&R',     'code' => '102', 'created_at' => Carbon::now()],
            ['name' => 'HR',      'code' => '103', 'created_at' => Carbon::now()],
            ['name' => 'Security','code' => '104', 'created_at' => Carbon::now()]
        ];
        foreach ($aryBranches as $branch) {
            DB::table('files')->insert(['name' => $branch['name'],'code'=>$branch['code'],'created_at'=>$branch['created_at']]);
        }
    }
}
