<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function printDocument(Request $request)
    {
        abort_if(Gate::denies('documents_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $document = Document::where('id',$request->documentID)->first();
        $document->load('classification','department','documentType','reference', 'attachments', 'recipients', 'user');
        $signingAuthorityID = $document->signing_authority_id;
        $signInData = [];
        $user = User::where('userID', $signingAuthorityID)->first();
        if ($user) {

            $user->load('department');
            if ($user->arm_designation) {
                array_push($signInData, $user->arm_designation);
            }
            array_push($signInData, $user->name);
            array_push($signInData, $user->department->name);
        }
        $recipientTo = $document->recipients->where('type','to');
        $recipientInfo = $document->recipients->where('type','info');

        $pdf = Pdf::loadView('pdf.document', ['document'=>$document,'signInData'=>$signInData,'recipientTo'=>$recipientTo,'recipientInfo'=>$recipientInfo]);
        return $pdf->download('document.pdf');
    }
}
