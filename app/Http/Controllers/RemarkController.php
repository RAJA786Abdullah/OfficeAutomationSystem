<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use App\Http\Requests\StoreRemarkRequest;
use App\Http\Requests\UpdateRemarkRequest;

class RemarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('remarks.index');
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
    public function store(StoreRemarkRequest $request)
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
    public function show(Remark $remark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remark $remark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRemarkRequest $request, Remark $remark)
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
    public function destroy(Remark $remark)
    {
        try {
            dd($remark);
        }catch (\Exception $e){
            dd($e);
        }
    }
}
