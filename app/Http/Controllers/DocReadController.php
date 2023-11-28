<?php

namespace App\Http\Controllers;

use App\Models\DocRead;
use Illuminate\Http\Request;

class DocReadController extends Controller
{
    public function store(Request $request)
    {
        try {

        }catch (\Exception $e){
            dd($e);
        }
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
