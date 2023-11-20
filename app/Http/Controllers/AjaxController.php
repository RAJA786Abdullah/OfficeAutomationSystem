<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Recipient;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handle($method, Request $request) {
        return $this->$method($request->all());
    }

    public function attachmentDelete($data){
         Attachment::where('id',$data['attachmentID'])->delete();
         return response()->json($data);
    }

    public function updateRecipientStatus($data){


        $recipientID = $data['recipientID'];
        Recipient::where('id', $recipientID)->update(['status' => 0]);
        return response()->json($data);
    }


}
