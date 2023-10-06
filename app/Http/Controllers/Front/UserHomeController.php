<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class  UserHomeController extends Controller
{
    public function index(){
//        abort_if(Gate::denies('front_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        if (auth()->user()->isAdmin()) {
            return redirect('/admin');
//        }
//        return view('front-end.home');
    }
}
