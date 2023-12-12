<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDepID = Auth::user()->department_id;
        $userID = Auth::id();
        $archives = DB::select("
                                     SELECT
                                        archives.*,
                                        documents.*,
                                        users.userID AS userID,
                                        users.name as userName,
                                        classifications.name as classficationName,
                                        files.name as fileName,
                                        files.code as fileCode,
                                        departments.name as departmentName,
                                        document_types.`name` as docTypeName
                                    FROM
                                        archives
                                        JOIN documents ON archives.document_id = documents.id
                                        JOIN users ON users.userID = archives.user_id
                                        join classifications on classifications.id = documents.classification_id
                                        join files on files.id = documents.file_id
                                        join departments on departments.id = documents.department_id
                                        join document_types on document_types.id = documents.document_type_id
                                    WHERE
                                        users.userID = $userID
                                        AND documents.deleted_at is null");
        return view('archives.index',compact('archives'));
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
    public function store(StoreArchiveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $archive)
    {
        $archive->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user', 'remarks');
        $signingAuthorityID = $archive->signing_authority_id;
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
        return view('archives.show',compact('archive', 'signInData', 'departmentUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArchiveRequest $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($archive)
    {
        Archive::where('document_id',$archive)->delete();
        return to_route('archives.index')->with('message','Document removed from archived list');
    }
}
