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
        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $unreadDocs = DB::select("
                    SELECT
                        *,
                        recipients.id as recipientID
                    FROM
                        recipients
                        INNER JOIN documents ON recipients.document_id = documents.id
                    WHERE
                        recipients.status = 1  AND recipients.name = '$userDepName' AND documents.out_dept != ''
        ");
        $unread = count($unreadDocs);

        $notApproved = DB::select("
                                    SELECT
                                            *,
                                                files.code as fileCode,
                                                departments.name as depName,
                                                documents.document_unique_identifier as uniqueID,
                                                documents.created_at as created_at,
                                                document_types.code as docCode,
                                                documents.id as docuID
                                        FROM
                                            documents
                                                INNER JOIN files on documents.file_id = files.id
                                                INNER JOIN departments on documents.department_id = departments.id
                                                INNER JOIN document_types on documents.document_type_id= document_types.id

                                        WHERE
                                            documents.out_dept IS NULL AND documents.department_id = '$userDepID' AND documents.is_draft != '1'");
        $notApproved = count($notApproved);

        $received = DB::select("
                                    SELECT
                                            *,
                                            files.code as fileCode,
                                            departments.name as depName,
                                            documents.document_unique_identifier as uniqueID,
                                            documents.created_at as created_at,
                                            document_types.code as docCode,
                                            documents.id as docuID
                                        FROM
                                            documents
                                            INNER JOIN files on documents.file_id = files.id
                                            INNER JOIN departments on documents.department_id = departments.id
                                            INNER JOIN document_types on documents.document_type_id= document_types.id
                                        WHERE
                                            documents.department_id != '$userDepID'");
        $received = count($received);

        $sent = DB::select("
                                    SELECT
                                            *,
                                            files.code as fileCode,
                                            departments.name as depName,
                                            documents.document_unique_identifier as uniqueID,
                                            documents.created_at ,
                                            document_types.code as docCode,
                                            documents.id as docuID
                                        FROM
                                            documents
                                            INNER JOIN files on documents.file_id = files.id
                                            INNER JOIN departments on documents.department_id = departments.id
                                            INNER JOIN document_types on documents.document_type_id= document_types.id
                                        WHERE
                                            documents.department_id = '$userDepID' AND documents.out_dept != ''");
        $sent = count($sent);

        $draft = Document::where('department_id','=',$userDepID)->where('is_draft',1)->get();
        $draft = count($draft);


        return view('home', compact( 'unreadDocs','unread','notApproved','received','sent','draft'));
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

    public function widgetFilter(Request $request){
        abort_if(Gate::denies('dashboard_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $notApproved = $notApproved = $unread = $sent = $received = $draft = 0;

        $filtered = [];
        if($request['filterData']){
            $filterData = $request['filterData'];
            switch ($filterData){
                case('unread'):
                    $filtered[] = 'unread';
                    $unread = 0;
                    break;

                case('notApproved'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                                files.code as fileCode,
                                                departments.name as depName,
                                                documents.document_unique_identifier as uniqueID,
                                                documents.created_at as created_at,
                                                document_types.code as docCode,
                                                documents.id as docuID
                                        FROM
                                            documents
                                                INNER JOIN files on documents.file_id = files.id
                                                INNER JOIN departments on documents.department_id = departments.id
                                                INNER JOIN document_types on documents.document_type_id= document_types.id

                                        WHERE
                                            documents.out_dept IS NULL AND documents.department_id = '$userDepID' AND documents.is_draft != '1' ");
                    $notApproved = count($filtered);
                    break;

                case('received'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            files.code as fileCode,
                                            departments.name as depName,
                                            documents.document_unique_identifier as uniqueID,
                                            documents.created_at as created_at,
                                            document_types.code as docCode,
                                            documents.id as docuID
                                        FROM
                                            documents
                                            INNER JOIN files on documents.file_id = files.id
                                            INNER JOIN departments on documents.department_id = departments.id
                                            INNER JOIN document_types on documents.document_type_id= document_types.id
                                        WHERE
                                            documents.department_id != '$userDepID'");
                    $received = count($filtered);
                    break;

                case('sent'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            files.code as fileCode,
                                            departments.name as depName,
                                            documents.document_unique_identifier as uniqueID,
                                            documents.created_at ,
                                            document_types.code as docCode,
                                            documents.id as docuID
                                        FROM
                                            documents
                                            INNER JOIN files on documents.file_id = files.id
                                            INNER JOIN departments on documents.department_id = departments.id
                                            INNER JOIN document_types on documents.document_type_id= document_types.id
                                        WHERE
                                            documents.department_id = '$userDepID' AND documents.out_dept != ''");
                    $sent = count($filtered);

                    break;

                case('draft'):
                    $filtered = Document::select('documents.*',
                                                'files.code as fileCode',
                                                'departments.name as depName',
                                                'documents.document_unique_identifier as uniqueID',
                                                'documents.created_at',
                                                'document_types.code as docCode',
                                                'documents.id as docuID',
                                                'documents.is_draft'
                                                )->join('files', 'documents.file_id', '=', 'files.id')
                                                ->join('departments', 'documents.department_id', '=', 'departments.id')
                                                ->join('document_types', 'documents.document_type_id', '=', 'document_types.id')
                                                ->where('documents.department_id', $userDepID)
                                                ->where('documents.is_draft', '1')
                                                ->get();
                    $draft = count($filtered);
                    break;
                default:
            }
        }

        $filtered;

        return response()->json(
            [
                'unread' => $unread,
                'notApproved' => $notApproved,
                'received' => $received,
                'sent' => $sent,
                'draft' => $draft,
                'filtered' => $filtered,
            ]
        );
    }
}
