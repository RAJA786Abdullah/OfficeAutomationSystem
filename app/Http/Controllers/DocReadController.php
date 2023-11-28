<?php

namespace App\Http\Controllers;

use App\Models\DocRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocReadController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        DocRead::create([
            'document_id' => $request->document_id,
            'userID' => $user['userID'],
            'department_id' => $user['department_id'],
            'comment' => $request->comment
        ]);
        return redirect()->back()->with('message', 'Comment Added')->with('reload', true);
    }

    public function destroy(DocRead $docRead)
    {
        try {
//            return to_route('departments.index')->with('message', 'Department Deleted successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }
}
