@extends('layouts.nav')
@section('title', 'Document Edit')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Edit Document</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('documents.index')}}">Document</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Document
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
        <form method="POST" action="{{route('documents.update',$document->id)}}" enctype="multipart/form-data" id="docUpdate">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col-sm-12 col-md-4 col-lg-4">
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

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label class="form-label required">{{ __('Document Type') }}</label>
                        <select name="document_type_id" class="form-select">
                            <option disabled>Select Document Type</option>
                            @foreach ($documentTypes as $documentType)
                                <option value="{{ $documentType->id }}" @if($documentType->id == $document->document_type_id) selected @endif {{ old('document_type_id') == $documentType->id ? 'selected' : '' }}>{{ $documentType?->name }} | {{ $documentType?->department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('document_type_id'))
                        <div class="text-danger">
                            {{ $errors->first('document_type_id') }}
                        </div>
                    @endif

                    <div class="col-sm-12 col-md-4 col-lg-4">
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

                </div>
                <div class="row g-2">
                    <div class="col-12 mt-3">
                        <label class="form-label required">{{ __('Subject') }}</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject', $document->subject) }}">
                    </div>
                    @if($errors->has('subject'))
                        <div class="text-danger">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Body') }}</label>
                        <input type="hidden" name="editor_content" id="editor_content">
                        <div id="toolbar-container"></div>
                        <div id="editor" style="height: 20em; border-color: #9D9999"></div>
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="row justify-content-center">
                                                <div class="d-flex">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="departmentUser" id="departmentUser1" value="department" checked>
                                                        <label class="form-check-label" for="departmentUser1">
                                                            Directorate
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="departmentUser" id="departmentUser3" value="executive">
                                                        <label class="form-check-label" for="departmentUser3">
                                                            Executive
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
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
                                                    <option value="All Dte">All Dte</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department?->name }}">{{ $department?->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="executive" style="display: none;">
                                                <h5 class="card-title text-center mt-5">Executive</h5>
                                                <select name="user" class="form-select select2" style="width: 100%">
                                                    <option disabled>Select Exec</option>
                                                    @foreach ($executiveOffices as $executiveOffice)
                                                        <option value="{{ $executiveOffice->name }}">{{ $executiveOffice->name   }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="user" style="display: none;">
                                                <h5 class="card-title text-center mt-5">Users</h5>
                                                <select name="user" class="form-select select2" style="width: 100%">
                                                    <option disabled>Select User</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}">{{ $user->name . ' | ' . $user->department?->name   }}</option>
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
                                                <textarea class="form-control" rows="4" name="to" id="to">@foreach($tos as $to){{ trim($to) }}@if (!$loop->last){{ "\n" }} @endif @endforeach</textarea>
                                            @if($errors->has('to'))
                                                <div class="text-danger">
                                                    {{ $errors->first('to') }}
                                                </div>
                                            @endif
                                            </label>
                                            <label class="form-label fw-bolder fs-5">{{ __('Info') }}
                                                <textarea class="form-control" rows="4" name="info" id="info">@foreach($infos as $info){{ trim($info) }}@if (!$loop->last){{ "\n" }}@endif @endforeach</textarea>
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card row">
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
                                                            <button class="btn btn-sm btn-outline-primary" id="annuxBtn" type="button" onclick="addNewAnnux();"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $rowID = null;
                                                @endphp
                                                @foreach($document->attachments as $index => $attachment)
                                                    @if($loop->last)
                                                        @php
                                                            $rowID = $attachment->id;
                                                        @endphp
                                                    @endif
                                                    <tr id="annuxrows{{ $attachment->id }}">
                                                        <input type="hidden" name="ids[]" value="{{ $attachment->id }}">
                                                        <td>
                                                            <p>{{ $attachment->name }}</p>
{{--                                                            <input type="text" name="name[]" class="form-control" required placeholder="Name" value="{{ $attachment->name }}">--}}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="attachmentsHidden[]" value="{{$attachment->path}}">
                                                            <p>{{ $attachment->path }}</p>
{{--                                                            <input type="file" name="attachment[]" class="form-control" value="{{ $attachment->path }}" placeholder="{{ $attachment->path }}">--}}
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <button class="btn btn-sm btn-outline-danger btnDelete" onclick="attachmentDelete({{$attachment->id}})" type="button"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <a href="{{route('documents.index')}}" type="button" class="btn btn-secondary">Back</a>

            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
@section('js')
    <script>
        {{--$(document).ready(function() {--}}
        {{--    var bodyValue = @json($document->body);--}}
        {{--    $('#editor').val(bodyValue);--}}

        {{--});--}}


        $(document).ready(function() {
            $('form').submit(function(event) {
                var editorContent = window.editor.getData();
                $('#editor_content').val(editorContent);
                $('#docUpdate').submit()
            });
        });
        $(document).ready(function() {
            DecoupledEditor.create(document.querySelector('#editor'), {
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            }).then(editor => {
                document.querySelector('#toolbar-container').appendChild(editor.ui.view.toolbar.element);
                window.editor = editor;
            }).catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });

            $('input[name="departmentUser"]').change(function() {
                if (this.value === "department") {
                    $('#department').show();
                    $('#executive').hide();
                    $('#user').hide();
                } else if(this.value === "executive"){
                    $('#department').hide();
                    $('#executive').show();
                    $('#user').hide();
                } else {
                    $('#department').hide();
                    $('#executive').hide();
                    $('#user').show();
                }
            });
        });
        $(document).ready(function() {
            var bodyValue = @json($document->body);
            // Wait until CKEditor is initialized
            if (editor) {
                editor.setData(bodyValue);
            } else {
                // If CKEditor is not yet initialized, set a timeout to try again
                setTimeout(function() {
                    if (editor) {
                        editor.setData(bodyValue);
                    }
                }, 1000);
            }
        });

        function attachmentDelete(attachmentID) {
        // Use an appropriate URL for your route, assuming it's a DELETE request
        $.ajax({
            url: "{{ route('ajax.handle',"attachmentDelete") }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                attachmentID: attachmentID,
            },
            success: function(data) {
                if (data) {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('Failed to delete attachment: ' + error);
            }
        });
    }



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


        var annux_rows = {{ $rowID ? $rowID : 0 }};
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
            // --annux_rows;
            $('#annux_rows').val(annux_rows);
        }
    </script>
@endsection
