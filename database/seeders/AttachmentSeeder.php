<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryAttachments = [
            ['document_id' => 1, 'type' => 'word', 'path' => ''],
            ['document_id' => 1, 'type' => 'word', 'path' => '']
        ];
        foreach ($aryAttachments as $attachment) {
            DB::table('attachments')->insert(['document_id' => $attachment['document_id'],'type'=>$attachment['type'],'path'=>$attachment['path']]);
        }
    }
}
