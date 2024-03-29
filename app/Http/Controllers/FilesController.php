<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesRequest;
use App\Http\Requests\UpdateFilesRequest;
use App\Models\Department;
use App\Models\Files;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = Files::all();
        return view('files.index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('files.create',compact('departments') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilesRequest $request)
    {
        try {
            Files::create($request->all());
            return to_route('files.create')->with('message', 'File Created successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Files $file)
    {
        $departments = Department::all();
        return view('files.edit',compact('file', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilesRequest $request, Files $file)
    {
        try {
            $file->update($request->all());
            return to_route('files.index')->with('message', 'Files Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Files $file)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $file->delete();
            return to_route('files.index')->with('message', 'Files Deleted successfully!');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
            return to_route('files.index')->with('error', 'Error Occurred While Deleting!');
        }
    }
}
