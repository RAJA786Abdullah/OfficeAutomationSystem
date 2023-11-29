@extends('layouts.nav')
@section('title', 'Archived Documents')
@section('app-content', 'app-content')

@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Archived Documents</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Archived Documents
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
                <h4 class="card-title">Archives</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped text-nowrap w-100 display">
                        <thead>
                        <tr>
                            <th class="wd-15p">Date</th>
                            <th class="wd-25p">File No</th>
                            <th class="wd-15p">Document No</th>
                            <th class="wd-25p">SecurityCl</th>
                            <th class="wd-25p">subject</th>
                            <th class="wd-25p">Created By</th>
                            <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($archives as $archive)
                            <tr>
                                <td> {{ $archive->id }} {{date(" d-m-Y", strtotime($archive->created_at))}}</td>
                                <td>{{ $archive->file->name }} | {{ $archive->file->code }}</td>
                                <td>{{ \App\Models\Document::documentTitle($archive->id) }}</td>
                                <td>{{ $archive->classification->name }}</td>
                                <td>{{ $archive->subject }}</td>
                                <td>{{ $archive->user->name }}</td>
                                <td style="padding: 0; margin: 0">
                                    <a href="{{ route('archives.show', $archive->document_id) }}" class="btn btn-sm btn-primary" style="padding: 4px" data-toggle="tooltip" title="Show">
                                        <i data-feather="eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-wrapper -->
            </div>
        </div>
        <!--/ Page layout -->
    </div>
@endsection
