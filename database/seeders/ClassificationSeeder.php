<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['name' => 'Personal', 'created_at' => Carbon::now()],
            ['name' => 'Immediate', 'created_at' => Carbon::now()],
            ['name' => 'Confidential', 'created_at' => Carbon::now()],
            ['name' => 'R&TD', 'created_at' => Carbon::now()]
        ];
        foreach ($aryClassifications as $classification) {
            DB::table('classifications')->insert(['name' => $classification['name'],'created_at'=>$classification['created_at']]);
        }
    }
}
