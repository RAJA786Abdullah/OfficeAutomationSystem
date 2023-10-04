@extends('layouts.app')
@section('body-class','blank-page')
@section('title', 'User Login')
@section('css')
    <style>
        .ti{
            font-size: 30px;
        }
        .nav-item:hover{
            border-radius: 8px;
            background-color: #82868b;
        }
        .ti{
            color: #ffffff;
        }
        </style>
@endsection
<nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="ti ti-home"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <a class="nav-item navbar-brand" href="#"><i class="ti ti-home rounded-pill"></i></a>
                <a class="nav-item navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti ti-logout"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>
