<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryDocuments = [
            ['classification_id' => 1,'department_id' => 1, 'document_type_id' => 1, 'file_id' => 1, 'document_unique_identifier' => 1, 'code' => 123, 'reference_id' => null, 'signing_authority_id' => 0, 'reference' => null, 'subject' => 'This is Subject', 'body' => 'This is Body', 'created_by' => 1, 'created_at' => Carbon::now()],
            ['classification_id' => 2,'department_id' => 2, 'document_type_id' => 2, 'file_id' => 2, 'document_unique_identifier' => 1, 'code' => 123, 'reference_id' => 1   , 'signing_authority_id' => 1, 'reference' => null, 'subject' => 'This is Subject', 'body' => 'This is Body', 'created_by' => 1, 'created_at' => Carbon::now()]
        ];
        foreach ($aryDocuments as $document) {
            DB::table('documents')->insert([
                'classification_id' => $document['classification_id'],
                'department_id' => $document['department_id'],
                'document_type_id'=>$document['document_type_id'],
                'file_id'=>$document['file_id'],
                'signing_authority_id'=>$document['signing_authority_id'],
                'document_unique_identifier'=>$document['document_unique_identifier'],
                'code'=>$document['code'],
                'reference_id'=>$document['reference_id'],
                'reference'=>$document['reference'],
                'subject'=>$document['subject'],
                'body'=>$document['body'],
                'created_by'=>$document['created_by'],
                'created_at'=>$document['created_at']
            ]);
        }
    }
}
