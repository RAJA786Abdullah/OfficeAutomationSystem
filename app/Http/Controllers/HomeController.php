<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Document;
use App\Models\Recipient;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class  HomeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('dashboard_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userDocuments = [];

//        $userID =Auth::id();
//        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
//        $userDepID = Auth::user()->department_id;
//        $userDepName = Department::where('id',$userDepID)->pluck('name')->first();

        $userDepName = Auth::user()->department->name;
        $recipientsGrouped = Recipient::all()->groupBy('document_id');
        $last10Groups = $recipientsGrouped->take(-10);
        $nameTypePairsResult = [];

        foreach ($last10Groups as $documentId => $recipients)
        {
            $names = $recipients->pluck('name')->toArray();
            $types = $recipients->pluck('type')->toArray();

            $pairs = array_map(function ($name, $type) use ($documentId) {
                return ['document_id' => $documentId, 'name' => $name, 'type' => $type];
            }, $names, $types);
            $nameTypePairsResult[] = $pairs;
        }
        foreach ($nameTypePairsResult as $results)
        {
            foreach ($results as $result)
            {
                if ($userDepName == $result['name'])
                {
                    $userDocuments[] = $result['document_id'];
                }
            }
        }
        $allDocuments = Document::all();
//        dd($allDocuments,$userDocuments);
        return view('home', compact('userDocuments', 'allDocuments'));
    }

    public function docShow(Request $request,$id)
    {
        $document = Document::where('id', $id)->first();
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user');
        $userID = Auth::id();
        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
        $departmentUsers = User::where('department_id', $userDepID)->get();

        return view('docShow', compact('document', 'departmentUsers'));
    }



}
