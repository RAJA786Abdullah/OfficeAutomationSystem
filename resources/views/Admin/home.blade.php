@extends('layouts.nav')
@section('title', 'dashboard')
@section('more-style')

@endsection
@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Page layout -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Page layout!</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Starter View
                </p>
            </div>
        </div>
    </div>
    <!--/ Page layout -->
</div>
@endsection
@section('js')

@endsection
