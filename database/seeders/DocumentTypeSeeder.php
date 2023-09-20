<?php

namespace Database\Seeders;

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
            ['name' => 'ION',      'department_id' => 1],
            ['name' => 'Min Sheet',     'department_id' => 1]
        ];
        foreach ($aryDocumentTypes as $documentType) {
            DB::table('document_types')->insert(['name' => $documentType['name'],'department_id'=>$documentType['department_id']]);
        }
    }
}
