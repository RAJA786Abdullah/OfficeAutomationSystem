<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handle($method, Request $request) {
        return $this->$method($request->all());
    }

    public function searchDashboardByDate($date){

        return response()->json($date);
    }
}
