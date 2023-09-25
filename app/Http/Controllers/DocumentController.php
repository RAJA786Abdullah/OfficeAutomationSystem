<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\DocumentType;
use App\Models\Files;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('attachments', 'recipients', 'file', 'documentType','department', 'classification')->get();
//        dd($documents);
        return view('documents.index');
    }

    public function create()
    {
        $classifications = Classification::all();
        $documentTypes = DocumentType::all();
        $departments = Department::all();
        $users = User::all();
        $files = Files::all();
        return view('documents.create', compact('classifications','documentTypes', 'files', 'departments', 'users'));
    }

    public function store(StoreDocumentRequest $request)
    {
        try {

            $userID = Auth::id();
            $document = Document::create([
                'classification_id' => $request->input('classification_id'),
                'document_type_id' => $request->input('document_type_id'),
                'file_id' => $request->input('file_id'),
                'subject' => $request->input('subject'),
                'body' => $request->input('body'),
                'created_by' => Auth::id(),
                'department_id' => Auth::user()->department_id,
                'document_unique_identifier' => 1,
            ]);

            $info = $request->input('info');
            $to = $request->input('to');
            $infoArray = preg_split('/\r\n|\r|\n/', $info);
            $toArray = preg_split('/\r\n|\r|\n/', $to);
            foreach ($infoArray as $info){
                Recipient::create([
                    'name' => $info,
                    'type' => 'info',
                    'document_id' => $document->id,
                    'userID' => $userID,
                ]);
            }

            foreach ($toArray as $to){
                Recipient::create([
                    'name' => $to,
                    'type' => 'to',
                    'document_id' => $document->id,
                    'userID' => $userID,
                ]);
            }

            foreach ($request->name as $key=>$name)
            {
                $attachment = $request->file('attachment')[$key];
                if ($attachment) {
                    $fileExtension = $attachment->getClientOriginalExtension();
                    $fileName = $attachment->getClientOriginalName();
                    $attachment->storeAs('public/attachments', $fileName );
                    Attachment::create([
                        'name' => $name,
                        'type' => $fileExtension,
                        'path' => $fileName, // Store the original filename
                        'document_id' => $document->id,
                    ]);
                }
            }

            $request->session()->flash('message', 'Document created successfully!');
            return redirect()->route('documents.index');
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
