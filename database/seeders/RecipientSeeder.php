<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aryRecipient = [
            ['name' => 'abc', 'type' => 'abc', 'document_id' => 1, 'userID' => 1],
            ['name' => 'abc', 'type' => 'xyz', 'document_id' => 2, 'userID' => 1]
        ];
        foreach ($aryRecipient as  $recipient) {
            DB::table('recipients')->insert([
                'name' =>  $recipient['name'],
                'type'=> $recipient['type'],
                'document_id'=> $recipient['document_id'],
                'userID'=> $recipient['userID']
            ]);
        }
    }
}
