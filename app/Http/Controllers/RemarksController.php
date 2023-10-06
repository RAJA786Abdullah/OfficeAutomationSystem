<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Remark;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RemarksController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('remarks_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.branches.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'remark' => 'required',
        ], [
            'remark.required' => 'Remarks required',
        ]);


        try {
            $userID = Auth::id();
            $request->userID = $userID;
            Remark::create([
                'remark' => $request->input('remark'),
                'userID' => $userID,
                'toUserID' => $request->input('toUser_id'),
                'document_id' => $request->input('document_id'),
            ]);
            return to_route('home')->with('message', ' added successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function show( )
    {
        //
    }


    public function edit( )
    {
        return view('admin.branches.edit');
    }

    public function update(Request $request)
    {
        try {
            return to_route('branches.index')->with('message', ' Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function destroy()
    {
        DB::beginTransaction();
        try {
            DB::commit();

            return to_route('branches.index')->with('message', ' Deleted successfully!');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
