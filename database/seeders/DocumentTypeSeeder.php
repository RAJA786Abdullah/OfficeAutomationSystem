<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryDocumentTypes = [
            ['name' => 'ION',       'code' => 604,'department_id' => 1, 'created_at' => Carbon::now()],
            ['name' => 'Min Sheet', 'code' => 601,'department_id' => 1, 'created_at' => Carbon::now()]
        ];
        foreach ($aryDocumentTypes as $documentType) {
            DB::table('document_types')->insert(['name' => $documentType['name'],'code' => $documentType['code'],'department_id'=>$documentType['department_id'],'created_at'=>$documentType['created_at']]);
        }
    }
}
