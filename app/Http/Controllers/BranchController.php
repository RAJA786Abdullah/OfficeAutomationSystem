<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;
use Gate;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('branch_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $branches = Branch::all();
        return view('branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        try {
            Branch::create($request->all());
            return to_route('branches.create')->with('message', 'Branch added successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        abort_if(Gate::denies('branch_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            $branch->update($request->all());
            return to_route('branches.index')->with('message', 'Branch Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $branch->delete();
            return to_route('branches.index')->with('message', 'Branch Deleted successfully!');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
