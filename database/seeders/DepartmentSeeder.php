<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryDepartments = [
            ['name' => 'IT', 'created_at' => Carbon::now()],
            ['name' => 'T&R', 'created_at' => Carbon::now()],
            ['name' => 'HR', 'created_at' => Carbon::now()],
            ['name' => 'Security', 'created_at' => Carbon::now()]
        ];
        foreach ($aryDepartments as $department) {
            DB::table('departments')->insert(['name' => $department['name'],'created_at'=>$department['created_at']]);
        }
    }
}
