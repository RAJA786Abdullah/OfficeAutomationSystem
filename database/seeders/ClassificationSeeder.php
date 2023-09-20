<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryClassifications = [
            ['name' => 'Personal'],
            ['name' => 'Immediate'],
            ['name' => 'Confidential'],
            ['name' => 'R&TD']
        ];
        foreach ($aryClassifications as $classification) {
            DB::table('classifications')->insert(['name' => $classification['name']]);
        }
    }
}
