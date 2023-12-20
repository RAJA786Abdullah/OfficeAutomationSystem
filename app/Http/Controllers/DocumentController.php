<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Archive;
use App\Models\Attachment;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Files;
use App\Models\Recipient;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mpdf\Mpdf;

class DocumentController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles[0]->roleName == 'Admin'){
            $documents = Document::with('attachments', 'recipients', 'file', 'documentType', 'department', 'classification')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $userDepID = Auth::user()->department_id;
            $documents = Document::where('department_id', $userDepID)
                ->with('attachments', 'recipients', 'file', 'documentType', 'department', 'classification')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('documents.index', compact('documents'));
    }

    public function create(Request $request)
    {
        $userID = Auth::id();
        $depID =  Auth::user()->department_id;
        $user = User::where('userID', $userID)->first();
        $dept_id = $user->department_id;
        $departmentName = Department::where('id', $dept_id)->pluck('name')->first();
        $authorizedUsers = User::where('department_id', $dept_id)->where('is_signing_authority', 1)->get();
        $classifications = Classification::all();
        $documentTypes = DocumentType::all();
        $departments = Department::where('name', '!=', $user->department->name)->get();
        $users = User::where('department_id', '!=', $dept_id)->get();
        $files = Files::where('department_id', $depID)->get();
        $documents = Document::all();
        $executiveOffices = User::whereHas('roles', function ($q) {
            $q->where('roleName', 'Executive');
        })->get();
        return view('documents.create', compact('classifications','documentTypes', 'files', 'departments', 'users', 'authorizedUsers','documents','executiveOffices','departmentName'));
    }

    public function preview(Request $request)
    {
        $document = $request->all();

        $previewData = array();
        $previewData['classification'] = strtoupper(Classification::where('id',$document['classification_id'])->pluck('name')->first());
        $departmentNumber =  DocumentType::where('id',$document['document_type_id'])->pluck('code')->first();
        $previewData['document_type'] =  strtoupper(DocumentType::where('id',$document['document_type_id'])->pluck('name')->first());
        $previewData['file'] = Files::where('id',$document['file_id'])->pluck('name')->first();
        $fileNumber = Files::where('id',$document['file_id'])->pluck('code')->first();
        $previewData['department_name'] = strtoupper($document['department_name']);
        $previewData['subject'] = $document['subject'];
        $previewData['editor_content'] = $document['editor_content'];
        $previewData['signing_authority'] = User::where('userID',$document['signing_authority_id'])->where('is_signing_authority',1)->pluck('name')->first();
        $previewData['to'] = $document['to'];
        $previewData['info'] = $document['info'];
        $departmentName = $document['department_name'];
        $previewData['officeCopy'] = Auth::user()->department?->name;
        $ionNumber = '...';
        $createdAt = date('d M Y', strtotime(Carbon::now()));
        $previewData['documentTitle'] = "$departmentNumber/$fileNumber/$ionNumber/$departmentName dated $createdAt";
        return response()->json($previewData);
    }

    public function store(StoreDocumentRequest $request)
    {
        $table = $request->input('body');
        if(strpos($table, '<td>') !== false){
            $table = str_replace('<td>', '<td style="border: 1px solid black">', $table);
        }
        try {
            $userID = Auth::id();
            $lastDocument = Document::where('department_id', Auth::user()->department_id)->latest()->first();
            if ($lastDocument) {
                $dui = ++$lastDocument->document_unique_identifier;
            }
            else{
                $dui = 1;
            }
            $allDte = 0;
            if($request->to == 'All Dte'){
                $allDte = 1;
            }

            $commonFields = [
                'documentID' => rand(10000000, 99999999),
                'classification_id' => $request->input('classification_id'),
                'document_type_id' => $request->input('document_type_id'),
                'file_id' => $request->input('file_id'),
                'subject' => $request->input('subject'),
                'body' => $request->input('editor_content'),
                'signing_authority_id' => $request->input('signing_authority_id'),
                'created_by' => $userID,
                'department_id' => Auth::user()->department_id,
                'document_unique_identifier' => $dui,
                'in_dept' => Auth::id(),
                'is_allDte' => $allDte,
            ];

            if ($request->reference) {
                $commonFields['reference'] = $request->input('reference');
            } elseif ($request->reference_id) {
                $commonFields['reference_id'] = $request->input('reference_id');
            }

            $document = Document::create($commonFields);

            $info = $request->input('info');
            $to = $request->input('to');
            $infoArray = preg_split('/\r\n|\r|\n/', $info);
            $toArray = preg_split('/\r\n|\r|\n/', $to);
            $infoArray = array_map('trim', $infoArray);
            $toArray = array_map('trim', $toArray);
            if ($infoArray){
                foreach ($infoArray as $info){
                   if ($info != ""){
                        Recipient::create([
                            'name' => $info,
                            'type' => 'info',
                            'document_id' => $document->id,
                            'userID' => $userID,
                        ]);
                   }
                }
            }
            if($toArray){
                foreach ($toArray as $to){
                    if ($to == 'All Dte'){
                        $depts = Department::where('id', '!=', Auth::user()->department_id)->get();
                        foreach ($depts as $dept){
                            Recipient::create([
                                'name' => $dept->name,
                                'type' => 'to',
                                'document_id' => $document->id,
                                'userID' => $userID,
                            ]);
                        }
                    }else {
                        Recipient::create([
                            'name' => $to,
                            'type' => 'to',
                            'document_id' => $document->id,
                            'userID' => $userID,
                        ]);
                    }
                }
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
            return redirect()->route('home');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public function show(Document $document)
    {
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user', 'remarks');
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

        $userID = Auth::id();
        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
        $departmentUsers = User::where('department_id', $userDepID)->get();
        return view('documents.show', compact('document', 'signInData', 'departmentUsers'));
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
        $executiveOffices = User::whereHas('roles', function ($q) {
            $q->where('roleName', 'Executive');
        })->get();
        return view('documents.edit', compact('document','classifications','documentTypes', 'files', 'departments', 'users', 'authorizedUsers','tos', 'infos','executiveOffices'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        DB::beginTransaction();
        try {
            $userID = Auth::id();
            $document->update([
                'classification_id' => $request->input('classification_id'),
                'document_type_id' => $request->input('document_type_id'),
                'file_id' => $request->input('file_id'),
                'subject' => $request->input('subject'),
                'body' => $request->input('editor_content'),
                'signing_authority_id' => $request->input('signing_authority_id'),
                'created_by' => $userID,
                'department_id' => Auth::user()->department_id,
                'document_unique_identifier' => 1,
                'in_dept' => Auth::id()
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
                if ($to == 'All Dte'){
                    $depts = Department::where('id', '!=', Auth::user()->department_id)->get();
                    foreach ($depts as $dept){
                        Recipient::create([
                            'name' => $dept->name,
                            'type' => 'to',
                            'document_id' => $document->id,
                            'userID' => $userID,
                        ]);
                    }
                }else {
                    Recipient::create([
                        'name' => $to,
                        'type' => 'to',
                        'document_id' => $document->id,
                        'userID' => $userID,
                    ]);
                }
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
            $request->session()->flash('message', 'Document Updated successfully!');
            return redirect()->route('home');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function destroy(Document $document, Request $request, $id)
    {
        try {
            $document->load(['attachments','recipients','remarks','archives']);
            $document->archives()->delete();
            $document->attachments()->delete();
            $document->attachments()->delete();
            $document->recipients()->delete();
            $document->remarks()->delete();
            $document->delete();
            $request->session()->flash('message', 'Document Deleted successfully!');
            return redirect()->back();
        }catch (\Exception $e){
            dd($e);
        }
    }

    public static function sendDocToSup(Request $request)
    {
        $document = Document::find($request->docID);
        $document->update(['in_dept' => $document->signing_authority_id, 'is_draft' => 0]);
        $request->session()->flash('message', 'Document Send successfully!');
        return redirect()->back();
    }

    public static function approveDoc(Request $request)
    {
        $document = Document::find($request->docID);
        $document->update(['out_dept' => Auth::id()]);
        $request->session()->flash('message', 'Document Approved successfully!');
        return redirect()->back();
    }

    public static function docDelete(Request $request, $id)
    {
        $document = Document::find($id);
        $document->load(['attachments','recipients','remarks','archives']);
        if ($document->attachments){
            $document->attachments()->delete();
        }
        elseif ($document->recipients){
            $document->recipients()->delete();
        }elseif ($document->remarks){
            $document->remarks()->delete();
        }elseif ($document->archives){
            $document->archives()->delete();
        }
        $document->delete();
        return redirect()->back();
    }

    public function docShowNotApprove(Request $request,$id)
    {
        $document = Document::where('id', $id)->first();
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user');
        $userID = Auth::id();
        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
        $departmentUsers = User::where('department_id', $userDepID)->get();
        return view('docShowNotApprove', compact('document', 'departmentUsers'));
    }

    public function docEditNotApprove($id)
    {
        $document = Document::where('id',$id)->get()->first();
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
        $executiveOffices = User::whereHas('roles', function ($q) {
            $q->where('roleName', 'Executive');
        })->get();
        return view('documents.edit', compact('document','classifications','documentTypes', 'files', 'departments', 'users', 'authorizedUsers','tos', 'infos','executiveOffices'));
    }

    public function archiveDocument(Request $request)
    {
        $documentID = $request->all()['documentID'];
        $archives = Archive::create([ 'document_id' => $documentID, 'is_archived'=>1, 'user_id' => Auth::id() ]);
        return response()->json(['document'=> $archives, 'message'=>'Document Added to Archived List.']);
    }
}
