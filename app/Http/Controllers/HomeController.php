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
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class  HomeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('dashboard_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDocuments = [];
        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $recipientsGrouped = Recipient::all()->groupBy('department_id');
        $last10Groups = $recipientsGrouped->take(-10);
        $nameTypePairsResult = [];

        foreach ($last10Groups as $recipients)
        {
            $names = $recipients->pluck('name')->toArray();
            $types = $recipients->pluck('type')->toArray();
            $documentID = $recipients->pluck('document_id')->toArray();

            $pairs = array_map(function ($name, $type, $documentID)  {
                return ['document_id' => $documentID, 'name' => $name, 'type' => $type];
            }, $names, $types, $documentID);
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
        $allDocuments1 = Document::orderBy('id', 'desc')->where('out_dept','!=',null);
        $notApprovedDocs = count(
            Document::
                where('department_id', $userDepID)
                ->where('out_dept', '=', Null)
                ->get()
        );
        $unread = count($allDocuments1->where('department_id',Auth::user()->department_id)->where('is_new',1)->where('department_id','!=',Auth::user()->department_id)->get());

        $sent = count(Document::where('department_id',$userDepID)->get());
        $received = count(Document::where('department_id','!=',$userDepID)->get());

        $allDocuments = Document::orderBy('id', 'desc')->where('out_dept','!=',null)->get();
        return view('home', compact('userDocuments', 'allDocuments','notApprovedDocs','unread','sent','received'));
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
