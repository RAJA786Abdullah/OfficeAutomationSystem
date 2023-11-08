<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
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

}
