<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DocRead;
use App\Models\Document;
use App\Models\Recipient;
use App\Models\User;
use Dflydev\DotAccessData\Data;
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
        $authID = Auth::id();
        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $departments = Department::where('id', '!=', $userDepID)->get();
        $unreadDocs = DB::select("
                    SELECT
                        *,
                        recipients.id as recipientID
                    FROM
                        recipients
                        INNER JOIN documents ON recipients.document_id = documents.id
                    WHERE
                        recipients.status = 1
                        AND recipients.name = '$userDepName'
                        AND documents.out_dept != ''
                        AND documents.deleted_at IS NULL
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
                                                LEFT JOIN archives ON documents.id = archives.document_id

                                        WHERE
                                            documents.in_dept = '$authID'
                                            AND documents.out_dept IS NULL
                                            AND documents.department_id = '$userDepID'
                                            AND documents.is_draft != '1'
                                            AND archives.document_id IS NULL
                                            AND documents.deleted_at IS NULL
                                        ");
        $notApproved = count($notApproved);

        $received = DB::select("
                                     SELECT
                                        *,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID,
                                        recipients.id AS recipientID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.NAME = '$userDepName'
                                        AND recipients.STATUS IS NULL
                                        AND recipients.deleted_at IS NULL
                                        AND archives.document_id IS NULL;
                                    ");
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
                                    	    LEFT JOIN archives ON documents.id = archives.document_id
                                        WHERE
                                            documents.department_id = '$userDepID'
                                            AND documents.out_dept != ''
                                            AND documents.deleted_at IS NULL
                                            AND archives.document_id IS NULL;
                                        ");
        $sent = count($sent);

        $draft = DB::select("
                                SELECT
                                    *,
                                    documents.created_at as document_created_at,
                                    files.code as fileCode,
                                    departments.name as depName,
                                    documents.document_unique_identifier as uniqueID,
                                    documents.created_at as created_at,
                                    document_types.code as docCode,
                                    documents.id as docuID
                                FROM documents
                                    INNER JOIN files on documents.file_id = files.id
                                    INNER JOIN departments on documents.department_id = departments.id
                                    INNER JOIN document_types on documents.document_type_id= document_types.id
                                    LEFT JOIN archives ON documents.id = archives.document_id
                                WHERE
                                    documents.out_dept IS NULL
                                    AND documents.department_id = '$userDepID'
                                    AND documents.is_draft = '1'
                                    AND archives.document_id IS NULL
                                    AND documents.created_by = $authID
                                    AND documents.deleted_at IS NULL
                                ORDER BY documents.id DESC");

//            Document::where('department_id','=',$userDepID)->where('is_draft',1)->where('created_by',Auth::id())->get();
        $draft = count($draft);

        $dirRemarks = DB::select("
                                        SELECT
                                            *,
                                            files.CODE AS fileCode,
                                            departments.NAME AS depName,
                                            documents.document_unique_identifier AS uniqueID,
                                            documents.created_at AS created_at,
                                            document_types.CODE AS docCode,
                                            documents.id AS docuID
                                            FROM
                                            documents
                                            INNER JOIN files ON documents.file_id = files.id
                                            INNER JOIN departments ON documents.department_id = departments.id
                                            INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	    LEFT JOIN archives ON documents.id = archives.document_id
                                            WHERE
                                            documents.in_dept = '$authID'
                                            AND documents.out_dept IS NULL
                                            AND documents.department_id = '$userDepID'
                                            AND documents.is_draft != '1'
                                            AND archives.document_id IS NULL
                                            AND documents.signing_authority_id != '$authID'
                                            AND documents.deleted_at IS NULL
                                        ");
        $dirRemarks = count($dirRemarks);
        return view('home', compact( 'unreadDocs','unread','notApproved','received','sent','draft','dirRemarks', 'departments'));
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

        $authID = Auth::id();
        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $notApproved = $unread = $read = $dirRemarks = $received = $draft = $sent = 0;

        $filtered = [];
        if($request['filterData']){
            $filterData = $request['filterData'];
            $searchDirectorate = request('searchDirectorate');

            switch ($filterData){
                case('unread'):
                    $query = "
                            SELECT
                                *,
                                documents.created_at AS document_created_at,
                                files.CODE AS fileCode,
                                departments.NAME AS depName,
                                documents.document_unique_identifier AS uniqueID,
                                document_types.CODE AS docCode,
                                documents.id AS docuID,
                                recipients.id AS recipientID,
                                recipients.STATUS AS STATUS
                            FROM recipients
                                INNER JOIN documents ON recipients.document_id = documents.id
                                INNER JOIN files ON documents.file_id = files.id
                                INNER JOIN departments ON documents.department_id = departments.id
                                INNER JOIN document_types ON documents.document_type_id = document_types.id
                                LEFT JOIN archives ON documents.id = archives.document_id
                            WHERE
                                recipients.NAME = 'ICT DTE'
                                AND recipients.STATUS IS NULL
                                AND archives.document_id IS NULL
                                AND recipients.deleted_at IS NULL
                            ";
                    if($searchDirectorate) {
                        $query .= "AND departments.name = '$searchDirectorate'";
                    }
                    $query .= 'ORDER BY documents.id DESC';
                    $filtered[] = DB::select($query);
                    $unread = count($filtered[0]);




//                    $filtered[] = DB::select("
//                                     SELECT
//                                        *,
//                                        documents.created_at as document_created_at,
//                                        files.CODE AS fileCode,
//                                        departments.NAME AS depName,
//                                        documents.document_unique_identifier AS uniqueID,
//                                        document_types.CODE AS docCode,
//                                        documents.id AS docuID
//                                    FROM
//                                        recipients
//                                        INNER JOIN documents ON recipients.document_id = documents.id
//                                        INNER JOIN files ON documents.file_id = files.id
//                                        INNER JOIN departments ON documents.department_id = departments.id
//                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
//                                        LEFT JOIN archives ON documents.id = archives.document_id
//                                    WHERE
//                                        recipients.NAME = '$userDepName'
//                                        AND recipients.STATUS IS NULL
//                                        AND archives.document_id IS NULL
//                                        AND recipients.deleted_at IS NULL
//                                    ORDER BY documents.id DESC
//                                    ");
                    $readQuery[] = DB::select("
                                    SELECT
                                        *,
                                        documents.created_at as document_created_at,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.status IS NOT NULL
                                        AND archives.document_id IS NULL
                                        AND documents.deleted_at IS NULL
                                    ");

                    $read = count($readQuery[0]);
                    break;
//                    $unread = count($filtered);
//                    $read = count($readQuery[0]);
//                    $read = count($filtered[0]);
//                    $unread = count($filtered);
//                    break;

                case('read'):
                    $query = "
                            SELECT
                                *,
                                documents.created_at as document_created_at,
                                files.CODE AS fileCode,
                                departments.NAME AS depName,
                                documents.document_unique_identifier AS uniqueID,
                                document_types.CODE AS docCode,
                                recipients.id AS recipientID,
                                recipients.status AS status,
                                documents.id AS docuID
                            FROM
                                recipients
                                INNER JOIN documents ON recipients.document_id = documents.id
                                INNER JOIN files ON documents.file_id = files.id
                                INNER JOIN departments ON documents.department_id = departments.id
                                INNER JOIN document_types ON documents.document_type_id = document_types.id
                                LEFT JOIN archives ON documents.id = archives.document_id
                            WHERE
                                recipients.name = '$userDepName'
                                AND recipients.status IS NOT NULL
                                AND archives.document_id IS NULL
                                AND documents.deleted_at IS NULL
                            ";

                    if ($searchDirectorate) {
                        $query .= " AND departments.name = '$searchDirectorate'";
                        $query .= 'ORDER BY documents.id DESC';
                        $filtered[] = DB::select($query);
                    } else {
                        $query .= 'ORDER BY documents.id DESC';
                        $filtered[] = DB::select($query);
                    }
                    $read = count($filtered[0]);
                    break;
//                    $filtered[] = DB::select("
//                                    SELECT
//                                        *,
//                                        documents.created_at as document_created_at,
//                                        files.CODE AS fileCode,
//                                        departments.NAME AS depName,
//                                        documents.document_unique_identifier AS uniqueID,
//                                        document_types.CODE AS docCode,
//                                        documents.id AS docuID
//                                    FROM
//                                        recipients
//                                        INNER JOIN documents ON recipients.document_id = documents.id
//                                        INNER JOIN files ON documents.file_id = files.id
//                                        INNER JOIN departments ON documents.department_id = departments.id
//                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
//                                    	LEFT JOIN archives ON documents.id = archives.document_id
//                                    WHERE
//                                        recipients.name = '$userDepName'
//                                        AND recipients.status IS NOT NULL
//                                        AND archives.document_id IS NULL
//                                        AND documents.deleted_at IS NULL
//                                    ");
//                    if ($searchDirectorate) {
//                        $filtered[] = " AND departments.name = '$searchDirectorate'";
//                    }
//                    $read = count($filtered[0]);
//
//                    dd($filtered);
//                    break;

                case('notApproved'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            documents.created_at as document_created_at,
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
                                                LEFT JOIN archives ON documents.id = archives.document_id

                                        WHERE
                                            documents.in_dept = '$authID'
                                          AND documents.out_dept IS NULL
                                          AND documents.department_id = '$userDepID'
                                          AND documents.is_draft != '1'
                                          AND archives.document_id IS NULL
                                          AND documents.deleted_at IS NULL
                                         ORDER BY documents.id DESC
                                        ");
                    $notApproved = count($filtered);
                    break;

                case('received'):
                    $query = "
                            SELECT
                                *,
                                documents.created_at as document_created_at,
                                files.CODE AS fileCode,
                                departments.NAME AS depName,
                                documents.document_unique_identifier AS uniqueID,
                                document_types.CODE AS docCode,
                                documents.id AS docuID,
                                recipients.id AS recipientID
                            FROM
                                recipients
                                INNER JOIN documents ON recipients.document_id = documents.id
                                INNER JOIN files ON documents.file_id = files.id
                                INNER JOIN departments ON documents.department_id = departments.id
                                INNER JOIN document_types ON documents.document_type_id = document_types.id
                                LEFT JOIN archives ON documents.id = archives.document_id
                            WHERE
                                recipients.NAME = '$userDepName'
                                AND recipients.STATUS IS NULL
                                AND archives.document_id IS NULL
                                AND recipients.deleted_at IS NULL
                            ";

                    if ($searchDirectorate) {
                        $query .= " AND departments.name = '$searchDirectorate'";
                        $query .= 'ORDER BY documents.id DESC';
                        $filtered[] = DB::select($query);
                    } else {
                        $query .= 'ORDER BY documents.id DESC';
                        $filtered[] = DB::select($query);
                    }
//                    $received = count($filtered);
//                    $filtered[] = DB::select("
//                                    SELECT
//                                        *,
//                                        documents.created_at as document_created_at,
//                                        files.CODE AS fileCode,
//                                        departments.NAME AS depName,
//                                        documents.document_unique_identifier AS uniqueID,
//                                        document_types.CODE AS docCode,
//                                        documents.id AS docuID,
//                                        recipients.id AS recipientID
//                                    FROM
//                                        recipients
//                                        INNER JOIN documents ON recipients.document_id = documents.id
//                                        INNER JOIN files ON documents.file_id = files.id
//                                        INNER JOIN departments ON documents.department_id = departments.id
//                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
//                                    	LEFT JOIN archives ON documents.id = archives.document_id
//                                    WHERE
//                                        recipients.NAME = '$userDepName'
//                                        AND recipients.STATUS IS NULL
//                                        AND archives.document_id IS NULL
//                                        AND recipients.deleted_at IS NULL
//                                     ORDER BY documents.id DESC
//                                    ");
                    $readQuery[] = DB::select("
                                    SELECT
                                        *,
                                        documents.created_at as document_created_at,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.status IS NOT NULL
                                        AND archives.document_id IS NULL
                                        AND documents.deleted_at IS NULL
                                    ORDER BY documents.id DESC
                                    ");
                    $read = count($readQuery[0]);
                    $received = count($filtered);
                    break;

                case('sent'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            documents.created_at as document_created_at,
                                            files.code as fileCode,
                                            departments.name as depName,
                                            documents.document_unique_identifier as uniqueID,
                                            documents.created_at,
                                            document_types.code as docCode,
                                            documents.id as docuID
                                        FROM
                                            documents
                                            INNER JOIN files on documents.file_id = files.id
                                            INNER JOIN departments on documents.department_id = departments.id
                                            INNER JOIN document_types on documents.document_type_id= document_types.id
                                            LEFT JOIN archives ON documents.id = archives.document_id
                                        WHERE
                                            documents.department_id = '$userDepID'
                                          AND documents.out_dept != ''
                                          AND archives.document_id IS NULL
                                          AND documents.deleted_at IS NULL
                                        ORDER BY documents.id DESC
                                        ");

                    $sent = count($filtered);
                    break;

                case('draft'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            documents.created_at as document_created_at,
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
                                            LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        documents.out_dept IS NULL
                                      AND documents.department_id = '$userDepID'
                                      AND documents.is_draft = '1'
                                      AND archives.document_id IS NULL
                                      AND documents.created_by = $authID
                                      AND documents.deleted_at IS NULL
                                    ORDER BY documents.id DESC
                                      ");
                    $draft = count($filtered);
                    break;

                case('dirRemarks'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            documents.created_at as document_created_at,
                                            files.CODE AS fileCode,
                                            departments.NAME AS depName,
                                            documents.document_unique_identifier AS uniqueID,
                                            documents.created_at AS created_at,
                                            document_types.CODE AS docCode,
                                            documents.id AS docuID
                                            FROM documents
                                                INNER JOIN files ON documents.file_id = files.id
                                                INNER JOIN departments ON documents.department_id = departments.id
                                                INNER JOIN document_types ON documents.document_type_id = document_types.id
                                                LEFT JOIN archives ON documents.id = archives.document_id
                                            WHERE documents.in_dept = '$authID'
                                                AND documents.out_dept IS NULL
                                                AND documents.department_id = '$userDepID'
                                                AND documents.is_draft != '1'
                                                AND archives.document_id IS NULL
                                                AND documents.signing_authority_id != '$authID'
                                                AND documents.deleted_at IS NULL
                                            ORDER BY documents.id DESC
                                      ");
                    $draft = count($filtered);
                    break;
                default:
            }
        }
        if ($searchDirectorate){
            $departments = Department::all();
            $unreadDocs = DB::select("
                                    SELECT
                                        *,
                                        recipients.id as recipientID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                    WHERE
                                        recipients.status = 1
                                        AND recipients.name = '$userDepName'
                                        AND documents.out_dept != ''
                                        AND documents.deleted_at IS NULL");
            $unread = count($unreadDocs);
            if (count($filtered) > 0){
                $noData = 1;
            }else{
                $noData = 0;
            }
            return view('home', compact('unread','notApproved', 'received','read', 'sent', 'draft', 'filtered', 'departments', 'unreadDocs', 'dirRemarks','noData' ));
        }else {
            return response()->json(
                [
                    'unread' => $unread,
                    'notApproved' => $notApproved,
                    'received' => $received,
                    'read' => $read,
                    'sent' => $sent,
                    'draft' => $draft,
                    'filtered' => $filtered,
                ]
            );
        }
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

    public function docShowReceived(Request $request,$id)
    {
        $document = Document::where('id', $id)->first();
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user','comments.user');
        $userID = Auth::id();
        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
        $departmentUsers = User::where('department_id', $userDepID)->get();

        return view('docShowReceived', compact('document', 'departmentUsers'));
    }

    public function searchFilter(Request $request)
    {
        return response()->json($request);
        abort_if(Gate::denies('dashboard_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $authID = Auth::id();
        $userDepName = Auth::user()->department?->name;
        $userDepID = Auth::user()->department_id;
        $notApproved = $unread = $read = $received = $draft = 0;


        $filtered = [];
        if($request['filterData']){
            $filterData = $request['filterData'];
            switch ($filterData){
                case('unread'):
                    $filtered[] = DB::select("
                                     SELECT
                                        *,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID,
	                                    recipients.id AS recpID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                        LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.NAME = '$userDepName'
                                        AND recipients.STATUS IS NULL
                                        AND archives.document_id IS NULL
                                        AND recipients.deleted_at IS NULL");

                    $readQuery[] = DB::select("
                                    SELECT
                                        *,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.status IS NOT NULL
                                        AND archives.document_id IS NULL
                                        AND documents.deleted_at IS NULL
                                    ");
                    $read = count($readQuery[0]);
                    $unread = count($filtered);
                    break;

                case('read'):
                    $filtered[] = DB::select("
                                    SELECT
                                        *,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID,
	                                    recipients.id AS recpID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.status IS NOT NULL
                                      AND archives.document_id IS NULL
                                      AND documents.deleted_at IS NULL
                                    ");
                    $read = count($filtered[0]);
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
                                                LEFT JOIN archives ON documents.id = archives.document_id
                                        WHERE
                                            documents.in_dept = '$authID'
                                          AND documents.out_dept IS NULL
                                          AND documents.department_id = '$userDepID'
                                          AND documents.is_draft != '1'
                                          AND archives.document_id IS NULL
                                          AND documents.deleted_at IS NULL
                                        ");
                    $notApproved = count($filtered);
                    break;

                case('received'):
                    $filtered[] = DB::select("
                                    SELECT
                                        *,
                                        documents.created_at AS document_created_at,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID,
                                        recipients.id AS recipientID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                        LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.STATUS IS NULL
                                        AND archives.document_id IS NULL
                                        AND recipients.deleted_at IS NULL
                                    ");
                    $readQuery[] = DB::select("
                                    SELECT
                                        *,
                                        files.CODE AS fileCode,
                                        departments.NAME AS depName,
                                        documents.document_unique_identifier AS uniqueID,
                                        document_types.CODE AS docCode,
                                        documents.id AS docuID
                                    FROM
                                        recipients
                                        INNER JOIN documents ON recipients.document_id = documents.id
                                        INNER JOIN files ON documents.file_id = files.id
                                        INNER JOIN departments ON documents.department_id = departments.id
                                        INNER JOIN document_types ON documents.document_type_id = document_types.id
                                    	LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        recipients.name = '$userDepName'
                                        AND recipients.status IS NOT NULL
                                      AND archives.document_id IS NULL
                                      AND documents.deleted_at IS NULL
                                    ");
                    $read = count($readQuery[0]);
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
                                            LEFT JOIN archives ON documents.id = archives.document_id
                                        WHERE
                                            documents.department_id = '$userDepID'
                                          AND documents.out_dept != ''
                                          AND archives.document_id IS NULL
                                          AND documents.deleted_at IS NULL
                                        ");
                    $sent = count($filtered);

                    break;

                case('draft'):
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
                                            LEFT JOIN archives ON documents.id = archives.document_id
                                    WHERE
                                        documents.out_dept IS NULL
                                      AND documents.department_id = '$userDepID'
                                      AND documents.is_draft = '1'
                                      AND archives.document_id IS NULL
                                      AND documents.created_by = $authID
                                      AND documents.deleted_at IS NULL");
                    $draft = count($filtered);
                    break;

                case('dirRemarks'):
                    $filtered[] = DB::select("
                                    SELECT
                                            *,
                                            files.CODE AS fileCode,
                                            departments.NAME AS depName,
                                            documents.document_unique_identifier AS uniqueID,
                                            documents.created_at AS created_at,
                                            document_types.CODE AS docCode,
                                            documents.id AS docuID
                                            FROM
                                            documents
                                            INNER JOIN files ON documents.file_id = files.id
                                            INNER JOIN departments ON documents.department_id = departments.id
                                            INNER JOIN document_types ON documents.document_type_id = document_types.id
                                            LEFT JOIN archives ON documents.id = archives.document_id
                                            WHERE
                                            documents.in_dept = '$authID'
                                            AND documents.out_dept IS NULL
                                            AND documents.department_id = '$userDepID'
                                            AND documents.is_draft != '1'
                                            AND archives.document_id IS NULL
                                            AND documents.signing_authority_id != '$authID'
                                            AND documents.deleted_at IS NULL
                                      ");
                    $draft = count($filtered);
                    break;
                default:
            }
        }
    }
}
