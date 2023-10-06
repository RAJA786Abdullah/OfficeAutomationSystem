<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Files;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('attachments', 'recipients', 'file', 'documentType','department', 'classification')->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $userID = Auth::id();
        $user = User::where('userID', $userID)->first();
        $dept_id = $user->department_id;
        $authorizedUsers = User::where('department_id', $dept_id)->where('is_signing_authority', 1)->get();
        $classifications = Classification::all();
        $documentTypes = DocumentType::all();
        $departments = Department::all();
        $users = User::all();
        $files = Files::all();
        return view('admin.documents.create', compact('classifications','documentTypes', 'files', 'departments', 'users', 'authorizedUsers'));
    }

    public function store(StoreDocumentRequest $request)
    {
        DB::beginTransaction();
        try {
            $userID = Auth::id();
            $document = Document::create([
                'classification_id' => $request->input('classification_id'),
                'document_type_id' => $request->input('document_type_id'),
                'file_id' => $request->input('file_id'),
                'subject' => $request->input('subject'),
                'body' => $request->input('body'),
                'signing_authority_id' => $request->input('signing_authority_id'),
                'created_by' => $userID,
                'department_id' => Auth::user()->department_id,
                'document_unique_identifier' => 1,
            ]);

            $info = $request->input('info');
            $to = $request->input('to');
            $infoArray = preg_split('/\r\n|\r|\n/', $info);
            $toArray = preg_split('/\r\n|\r|\n/', $to);
            $infoArray= array_map('trim', $infoArray);
            $toArray= array_map('trim', $toArray);
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

            if ($request->name) {
                foreach ($request->name as $key => $name) {
                    $attachment = $request->file('attachment')[$key];
                    if ($attachment) {
                        $fileExtension = $attachment->getClientOriginalExtension();
                        $fileName = $attachment->getClientOriginalName();
                        $attachment->storeAs('public/attachments', $fileName);
                        Attachment::create([
                            'name' => $name,
                            'type' => $fileExtension,
                            'path' => $fileName, // Store the original filename
                            'document_id' => $document->id,
                        ]);
                    }
                }
            }
            DB::commit();
            $request->session()->flash('message', 'Document created successfully!');
            return redirect()->route('documents.index');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public function show(Document $document)
    {
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user');
        $signingAuthorityID = $document->signing_authority_id;
        $signInData = [];
        $user = User::where('userID', $signingAuthorityID)->first();
        if ($user)
        {
            $user->load('department');
            if ($user->arm_designation) {
                array_push($signInData, $user->arm_designation);
            }
            array_push($signInData, $user->name);
            array_push($signInData, $user->department->name);
        }
        return view('documents.show', compact('document', 'signInData'));
    }

    public function edit(Document $document)
    {
        $tos = [];
        $infos = [];
        $userID = Auth::id();
        $document->load('recipients','attachments');
        foreach ($document->recipients as $recipient){
            if ($recipient->type == 'to'){
                array_push($tos,$recipient->name);
            }
            if ($recipient->type == 'info'){
                array_push($infos,$recipient->name);
            }
        }

        $user = User::where('userID', $userID)->first();
        $dept_id = $user->department_id;
        $authorizedUsers = User::where('department_id', $dept_id)->where('is_signing_authority', 1)->get();
        $classifications = Classification::all();
        $documentTypes = DocumentType::all();
        $departments = Department::all();
        $users = User::all();
        $files = Files::all();
        return view('admin.documents.edit', compact('document','classifications','documentTypes', 'files', 'departments', 'users', 'authorizedUsers','tos', 'infos'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
//        DB::beginTransaction();
        try {
            $userID = Auth::id();
            $document->update([
                'classification_id' => $request->input('classification_id'),
                'document_type_id' => $request->input('document_type_id'),
                'file_id' => $request->input('file_id'),
                'subject' => $request->input('subject'),
                'body' => $request->input('body'),
                'signing_authority_id' => $request->input('signing_authority_id'),
                'created_by' => $userID,
                'department_id' => Auth::user()->department_id,
                'document_unique_identifier' => 1,
            ]);
            $info = $request->input('info');
            $to = $request->input('to');
            $infoArray = preg_split('/\r\n|\r|\n/', $info);
            $toArray = preg_split('/\r\n|\r|\n/', $to);
            $infoArray= array_map('trim', $infoArray);
            $toArray= array_map('trim', $toArray);
            $doc = $document->load('recipients');
            foreach($doc->recipients as $recipient){
                $recipient->delete();
            }
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

            //update attachment table where document_id is the one in Request
            if ($request->name) {
                $attachments = $document->load('attachments');
                foreach($attachments->attachments as $attachment) {
                    try {
                        $attachment->delete();
                    } catch (Exception $e) {
                        echo 'Error deleting attachment: ' . $e->getMessage();
                    }
                }
                $attachment = new Attachment();
                foreach ($request->name as $key => $name) {
                    $attachment->name = $name;
                    // Handle file upload
                    if ($request->hasFile('attachment') && $request->file('attachment')[$key]->isValid()) {
                        $file = $request->file('attachment')[$key];
                        $fileExtension = $file->getClientOriginalExtension();
                        $fileName = $file->getClientOriginalName();
                        $file->storeAs('public/attachments', $fileName);
                        $attachment->type = $fileExtension;
                        $attachment->path = $fileName;
                    } elseif ($request->attachmentsHidden && isset($request->attachmentsHidden[$key])) {
                        // Use the existing attachment path if provided
                        $attachment->path = $request->attachmentsHidden[$key];
                        $attachment->type = pathinfo($attachment->path, PATHINFO_EXTENSION);
                    } else {
                        dd('Error');
                        // Handle validation error for attachments
                    }
                    // Associate the attachment with the document
                    $attachment->document_id = $document->id;
                    $attachment->save();
                }
            }
            DB::commit();
            $request->session()->flash('message', 'Document Updated successfully!');
            return redirect()->route('documents.index');
        }catch (\Exception $e){
            DB::rollBack();
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
