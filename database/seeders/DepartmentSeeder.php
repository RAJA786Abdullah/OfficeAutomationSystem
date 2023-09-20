<?php

namespace Database\Seeders;

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
            ['name' => 'IT'],
            ['name' => 'T&R'],
            ['name' => 'HR'],
            ['name' => 'Security']
        ];
        foreach ($aryDepartments as $department) {
            DB::table('departments')->insert(['name' => $department['name']]);
        }
    }
}
