<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryRemarks = [
            ['remark' => 'abc', 'recommendation' => '', 'userID' => 1, 'document_id' => 1, 'created_at' => Carbon::now()],
            ['remark' => '', 'recommendation' => 'xyz', 'userID' => 1, 'document_id' => 1, 'created_at' => Carbon::now()]
        ];
        foreach ($aryRemarks as $remark) {
            DB::table('remarks')->insert([
                'remark' => $remark['remark'],
                'recommendation'=>$remark['recommendation'],
                'userID'=>$remark['userID'],
                'document_id'=>$remark['document_id'],
                'created_at'=>$remark['created_at']
            ]);
        }
    }
}
