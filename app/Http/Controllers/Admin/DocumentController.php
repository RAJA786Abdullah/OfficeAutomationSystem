<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Files;
use App\Models\User;

class DocumentController extends Controller
{
    public function index()
    {
        return view('admin.documents.index');
    }

    public function create()
    {
        $classifications = Classification::all();
        $documentTypes = DocumentType::all();
        $departments = Department::all();
        $users = User::all();
        $files = Files::all();
        return view('admin.documents.create', compact('classifications','documentTypes', 'files', 'departments', 'users'));
    }

    public function store(StoreDocumentRequest $request)
    {
        try {
            dd($request->all());
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function show(Document $document)
    {
        //
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        try {
            dd($request->all());
        }catch (\Exception $e){
            dd($e);
        }
    }

    public function destroy(Document $document)
    {
        try {
            dd($document);
        }catch (\Exception $e){
            dd($e);
        }
    }
}
