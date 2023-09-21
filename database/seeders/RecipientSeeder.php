<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['name' => 'abc', 'type' => 'abc', 'document_id' => 1, 'userID' => 1, 'created_at' => Carbon::now()],
            ['name' => 'abc', 'type' => 'xyz', 'document_id' => 2, 'userID' => 1, 'created_at' => Carbon::now()]
        ];
        foreach ($aryRecipient as  $recipient) {
            DB::table('recipients')->insert([
                'name' =>  $recipient['name'],
                'type'=> $recipient['type'],
                'document_id'=> $recipient['document_id'],
                'userID'=> $recipient['userID'],
                'created_at'=>$recipient['created_at']
            ]);
        }
    }
}
