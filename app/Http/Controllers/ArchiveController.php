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
        $archives = Archive::with('document.user','document.attachments', 'document.recipients', 'document.file', 'document.documentType', 'document.department', 'document.classification')->join('documents', 'archives.document_id', '=', 'documents.id')
           ->where('user_id',Auth::id())
            ->get();
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
