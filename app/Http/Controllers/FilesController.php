<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Http\Requests\StoreFilesRequest;
use App\Http\Requests\UpdateFilesRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilesRequest $request)
    {
        try {
            dd($request->all());
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
    public function edit(Files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilesRequest $request, Files $files)
    {
        try {
            dd($request->all());
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Files $files)
    {
        try {
            dd($files);
        }catch (\Exception $e){
            dd($e);
        }
    }
}
