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
            ['name' => 'Software',    'department_id' => 1, 'code' => '101', 'created_at' => Carbon::now()],
            ['name' => 'Networks',    'department_id' => 1, 'code' => '102', 'created_at' => Carbon::now()],
            ['name' => 'Telecom',     'department_id' => 1, 'code' => '103', 'created_at' => Carbon::now()],
            ['name' => 'Procurement', 'department_id' => 1, 'code' => '104', 'created_at' => Carbon::now()],
        ];
        foreach ($aryBranches as $branch) {
            DB::table('files')->insert([
                'name' => $branch['name'],
                'department_id' => $branch['department_id'],
                'code'=>$branch['code'],
                'created_at'=>$branch['created_at']]);
        }
    }
}
