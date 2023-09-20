<?php

namespace Database\Seeders;

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
            ['name' => 'IT',      'location' => 'Quetta'],
            ['name' => 'T&R',     'location' => 'Quetta'],
            ['name' => 'HR',      'location' => 'Quetta'],
            ['name' => 'Security','location' => 'Quetta']
        ];
        foreach ($aryBranches as $branch) {
            DB::table('branches')->insert(['name' => $branch['name'],'location'=>$branch['location']]);
        }
    }
}
