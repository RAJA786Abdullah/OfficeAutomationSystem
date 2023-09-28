@extends('layouts.nav')
@section('title', 'Document Create')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Add Document</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('documents.index')}}">Documents</a>
                        </li>
                        <li class="breadcrumb-item active">Add Document
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
        @include('partials.message')
        <div class="card-header">
            <h4 class="card-title">Add Document</h4>
        </div>
        <form method="POST" action="{{route('documents.store')}}" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Classification') }}</label>
                        <select name="classification_id" class="form-select">
                            <option disabled>Select Classification</option>
                            @foreach ($classifications as $classification)
                                <option value="{{ $classification->id }}" {{ old('classification_id') == $classification->id ? 'selected' : '' }}>{{ $classification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('classification_id'))
                        <div class="text-danger">
                            {{ $errors->first('classification_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Document Type') }}</label>
                        <select name="document_type_id" class="form-select">
                            <option disabled>Select Document Type</option>
                            @foreach ($documentTypes as $documentType)
                                <option value="{{ $documentType->id }}" {{ old('document_type_id') == $documentType->id ? 'selected' : '' }}>{{ $documentType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('document_type_id'))
                        <div class="text-danger">
                            {{ $errors->first('document_type_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('File') }}</label>
                        <select name="file_id" class="form-select">
                            <option disabled>Select File</option>
                            @foreach ($files as $file)
                                <option value="{{ $file->id }}" {{ old('file_id') == $file->id ? 'selected' : '' }}>{{ $file->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('file_id'))
                        <div class="text-danger">
                            {{ $errors->first('file_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Subject') }}</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                    </div>
                    @if($errors->has('subject'))
                        <div class="text-danger">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Body') }}</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                    </div>
                    @if($errors->has('body'))
                        <div class="text-danger">
                            {{ $errors->first('body') }}
                        </div>
                    @endif

                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="col-12">
                                <label class="form-label required">{{ __('Signing Authority') }}</label>
                                @foreach($authorizedUsers as $index => $user)
                                    <div class="form-check">
                                        @if($index < 1)
                                            <input class="form-check-input" type="radio" name="signing_authority_id" id="user{{ $user->userID }}" value="{{ $user->userID }}" checked>
                                            <label class="form-check-label" for="user{{ $user->userID }}">
                                                {{ $user->name }}
                                            </label>
                                        @else
                                            <input class="form-check-input" type="radio" name="signing_authority_id" id="user{{ $user->userID }}" value="{{ $user->userID }}">
                                            <label class="form-check-label" for="user{{ $user->userID }}">
                                                {{ $user->name }}
                                            </label>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($errors->has('signing_authority_id'))
                        <div class="text-danger">
                            {{ $errors->first('signing_authority_id') }}
                        </div>
                    @endif


                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="departmentUser" id="departmentUser1" value="department" checked>
                                                <label class="form-check-label" for="departmentUser1">
                                                    Directorate
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" >
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="departmentUser" id="departmentUser2" value="user">
                                                <label class="form-check-label" for="departmentUser2">
                                                    Users
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="department">
                                        <h5 class="card-title text-center mt-5">Directorate</h5>
                                        <select name="department" class="form-select select2" style="width: 100%">
                                            <option disabled>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->name }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="user" style="display: none;">
                                        <h5 class="card-title text-center mt-5">Users</h5>
                                        <select name="user" class="form-select select2" style="width: 100%">
                                            <option disabled>Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card d-flex justify-content-center align-items-center" style="height: 100%;">
                                    <div class="btn-group-vertical">
                                        <button type="button" class="btn btn-dark btn-rounded mt-2" onclick="clickTo()">To</button>
                                        <button type="button" class="btn btn-dark btn-rounded mt-2" onclick="clickInfo()">Info</button>
                                        <button type="button" class="btn btn-dark btn-rounded mt-2" disabled>Copy</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <label class="form-label fw-bolder fs-5">{{ __('To') }}
                                        <textarea class="form-control" rows="4" name="to" id="to" > {{ old('to') }}</textarea>
                                        @if($errors->has('to'))
                                            <div class="text-danger">
                                                {{ $errors->first('to') }}
                                            </div>
                                        @endif
                                    </label>
                                    <label class="form-label fw-bolder fs-5">{{ __('Info') }}
                                        <textarea class="form-control mt-2" rows="4" name="info" id="info" > {{ old('info') }}</textarea>
                                        @if($errors->has('info'))
                                            <div class="text-danger">
                                                {{ $errors->first('info') }}
                                            </div>
                                        @endif
                                    </label>
                                    <label class="form-label fw-bolder fs-5">{{ __('ID') }}
                                        <p class="form-control border-primary text-black fs-5 mt-2" id="copy" disabled>{{ Auth::user()->department->name }}</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card row mt-4">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width:25%;">Name</th>
                                    <th style="text-align: center; width:25%;">File</th>
                                    <th style="text-align: center; width:25%;">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="annuxFields">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <button class="btn btn-sm btn-outline-primary" id="annuxBtn" type="button" value="{{ old('annux_rows') ? old('annux_rows') : 0}}" onclick="addNewAnnux()"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="row">
                                <div class="card-header d-flex justify-content-center bg-primary">
                                    <h4 class="card-title text-light">Select Reference</h4>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="card-title text-center mt-5">Classifications</h5>
                                    <select name="filter_classification" class="form-select select2" style="width: 100%">
                                        <option disabled>Select Classification</option>
                                        @foreach ($classifications as $classification)
                                            <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="card-title text-center mt-5">Departments</h5>
                                    <select name="filter_department" class="form-select select2" style="width: 100%">
                                        <option disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="card-title text-center mt-5">Files</h5>
                                    <select name="filter_file" class="form-select select2" style="width: 100%">
                                        <option disabled>Select File</option>
                                        @foreach ($files as $file)
                                            <option value="{{ $file->id }}">{{ $file->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="card-title text-center mt-5">References</h5>
                                    <select name="reference" class="form-select selectTwo" style="width: 100%">
                                        <option disabled>Select Department</option>
{{--                                        @foreach ($departments as $department)--}}
{{--                                            <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('documents.index')}}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body');

            $('input[name="departmentUser"]').change(function() {
                if (this.value === "department") {
                    $('#department').show();
                    $('#user').hide();
                } else {
                    $('#department').hide();
                    $('#user').show();
                }
            });
        });
        function clickTo() {
            var appendedValue = '';
            var departmentUser = $('input[name="departmentUser"]:checked').val();
            var selectName = departmentUser === "department" ? "department" : "user";
            var newValue = $("select[name='" + selectName + "']").val();
            var infoCurrentValue = $("#info").val();
            var toCurrentValue = $("#to").val();
            if (infoCurrentValue.indexOf(newValue) !== -1) {
                return swal({
                    title: newValue + " Already exists in Info",
                    icon: "warning",
                });
            }
            if (toCurrentValue.indexOf(newValue) !== -1) {
                return swal({
                    title: newValue + " Already exists",
                    icon: "warning",
                });
            } else {
                if (!toCurrentValue || toCurrentValue.trim() === '')
                {
                    appendedValue =newValue
                }else {
                    appendedValue =toCurrentValue+'\n'+newValue;
                }
                $("#to").val(appendedValue);
            }
        }
        function clickInfo() {
            var appendedValue = '';
            var departmentUser = $('input[name="departmentUser"]:checked').val();
            var selectName = departmentUser === "department" ? "department" : "user";
            var newValue = $("select[name='" + selectName + "']").val();
            var infoCurrentValue = $("#info").val();
            var toCurrentValue = $("#to").val();
            if (toCurrentValue.indexOf(newValue) !== -1) {
                return swal({
                    title: newValue + " exists in To",
                    icon: "warning",
                });
            }
            if (infoCurrentValue.indexOf(newValue) !== -1) {
                return swal({
                    title: newValue + " Already exists",
                    icon: "warning",
                });
            } else {
                console.log(infoCurrentValue)
                if (!infoCurrentValue || infoCurrentValue.trim() === '')
                {
                    appendedValue=newValue
                }else {
                        appendedValue = infoCurrentValue+'\n'+newValue;
                    }
                $("#info").val(appendedValue);
            }
        }

        var annux_rows = {{ old('annux_rows') ? old('annux_rows') : 0 }};
        function addNewAnnux(){
            annux_rows +=1;

            var annuxField =
                `<tr id="annux_rows_${annux_rows}">`+
                '<tr>'+
                '<td>'+
                '<input type="text" name="name[]" class="form-control" required placeholder="Name">'+
                '</td>'+
                '<td>'+
                '<input type="file" name="attachment[]" class="form-control" required>'+
                '</td>'+
                '<td>'+
                '<div class="form-group">'+

                '<button class="btn btn-sm btn-outline-danger btnDelete" onclick="bindRowRemoveClick(this)" type="button"><i class="fa fa-trash"></i></button>'+
                '</div>'+
                '</td>'+
                '</tr>';
            $('#annuxFields').append(annuxField);
        }
        function bindRowRemoveClick(thisElem) {
            $(thisElem).closest('tr').remove();
            --annux_rows;
            $('#annux_rows').val(annux_rows);


        }
    </script>
@endsection
