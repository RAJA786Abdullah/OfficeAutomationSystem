<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DocumentType;
use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('document_type_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documentTypes = DocumentType::all();
        return view('document_types.index',compact('documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('document_types.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        try {
            DocumentType::create($request->all());
            return to_route('document_types.create')->with('message', 'Document Type added successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentType $documentType)
    {
        $departments = Department::all();
        return view('document_types.edit',compact('documentType','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        try {
            $documentType->update($request->all());
            return to_route('document_types.index')->with('message', 'Document Type Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentType $documentType)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $documentType->delete();
            return to_route('document_types.index')->with('message', 'Document Type Deleted successfully!');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
