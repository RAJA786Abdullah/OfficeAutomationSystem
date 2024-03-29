<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['document_id' => 1, 'type' => 'word', 'name' => 'word file', 'path' => '', 'created_at' => Carbon::now()],
            ['document_id' => 1, 'type' => 'word', 'name' => 'word file', 'path' => '', 'created_at' => Carbon::now()]
        ];
        foreach ($aryAttachments as $attachment) {
            DB::table('attachments')->insert(['document_id' => $attachment['document_id'],'type'=>$attachment['type'],'name'=>$attachment['name'],'path'=>$attachment['path'],'created_at'=>$attachment['created_at']]);
        }
    }
}
