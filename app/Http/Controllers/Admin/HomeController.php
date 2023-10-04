<?php

namespace App\Http\Controllers\Admin;

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
//        $userID =Auth::id();
//        $userDepID = User::where('userID', $userID)->pluck('department_id')->first();
//        $userDepName = Department::where('id',$userDepID)->pluck('name')->first();
//        dd($userDepName);
        $recipientsGrouped = Recipient::all()->groupBy('document_id');
        $last10Groups = $recipientsGrouped->take(-10);

        $nameTypePairsResult = [];

// Loop through each group and populate the result array
        foreach ($last10Groups as $documentId => $recipients) {
            $names = $recipients->pluck('name')->toArray();
            $types = $recipients->pluck('type')->toArray();

            // Pair each name with its corresponding type and append to the result array
            $pairs = array_map(function ($name, $type) use ($documentId) {
                return ['document_id' => $documentId, 'name' => $name, 'type' => $type];
            }, $names, $types);

            $nameTypePairsResult[] = $pairs;
        }

// Now $nameTypePairsResult contains the desired structure
        foreach ($nameTypePairsResult as $results) {
            foreach ($results as $result) {
//                dump($result['document_id'] . ' - ' . $result['name'] . ' - ' . $result['type']);
            }
        }

//        dd('');

//        return $nameTypePairsResult;

//        $namesResult = [];
//        $typesToResult = [];
//        $typesInfoResult = [];
//
//        // Loop through each group and populate the result arrays
//        foreach ($recipientsGrouped as $documentId => $recipients) {
//            $names = $recipients->pluck('name')->toArray();
//            $types = $recipients->pluck('type')->toArray();
//
//            // Separate types into "to" and "info"
//            $typesTo = array_filter($types, function ($type) {
//                return $type === 'to';
//            });
//
//            $typesInfo = array_filter($types, function ($type) {
//                return $type === 'info';
//            });
//
//            // Append the names, types to, and types info arrays to the respective result arrays
//            $namesResult[] = $names;
//            $typesToResult[] = $typesTo;
//            $typesInfoResult[] = $typesInfo;
//        }
//
//        return [
//            'names' => $namesResult,
//            'types_to' => $typesToResult,
//            'types_info' => $typesInfoResult,
//        ];
//        $documents = Document::whereHas('recipients', function ($query) use ($userID) {
//
//            $query->where('type', 'to')->where('userID', $userID);
//        })->with('attachments')->get();
//        dd($documents);
        return view('admin.home');
    }
}
