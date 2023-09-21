<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Models\Document;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = Attachment::all();
        return view('attachments.index',compact('attachments'));
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
    public function store(StoreAttachmentRequest $request)
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
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
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
    public function destroy(Attachment $attachment)
    {
        try {
            dd($attachment);
        }catch (\Exception $e){
            dd($e);
        }
    }
}
