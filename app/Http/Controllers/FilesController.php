<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Http\Requests\StoreFilesRequest;
use App\Http\Requests\UpdateFilesRequest;
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
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilesRequest $request)
    {
        try {
            Files::create($request->all());
            return to_route('files.create')->with('message', 'Files Updated successfully!');
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
        return view('files.edit',compact('file'));
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
