<?php

namespace App\Http\Controllers\Admin;

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
        abort_if(Gate::denies('branch_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

    /**
     * Display the specified resource.
     */
    public function show( $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $branch)
    {
        return view('admin.branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $branch)
    {
        try {
            $branch->update($request->all());
            return to_route('branches.index')->with('message', ' Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $branch)
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
