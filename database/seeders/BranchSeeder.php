<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryBranches = [
            ['name' => 'Lahore',    'location' => 'Lahore',   'created_at' => Carbon::now()],
            ['name' => 'Islamabad', 'location' => 'Islamabad','created_at' => Carbon::now()],
            ['name' => 'Karachi',   'location' => 'Karachi',  'created_at' => Carbon::now()],
            ['name' => 'Peshawar',  'location' => 'Peshawar',   'created_at' => Carbon::now()],
            ['name' => 'Multan',    'location' => 'Multan',   'created_at' => Carbon::now()],
        ];
        foreach ($aryBranches as $branch) {
            DB::table('branches')->insert(['name' => $branch['name'],'location'=>$branch['location'],'created_at'=>$branch['created_at']]);
        }
    }
}
