@extends('layouts.nav')
@section('title', 'Doc Show')
@section('app-content', 'app-content')

@section('main-content')
    <div class="content-body">
        <!-- Page layout -->
        <div class="card" style="padding-left: 100px; padding-right: 100px">
            <div class="card-header">
                <h3 class="mb-0 card-title"><i class="fa fa-user"></i> <b> {{\App\Models\Document::documentTitle($document->id)}} </b></h3>
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('printDocument') }}" method="post">
                            @csrf
                            <input type="hidden" name="documentID" value="{{ $document->id }}">
                            <a href="{{route('home')}}" class="btn btn-primary ml-auto" style="color: white; padding: 4px" data-toggle="tooltip" title="Back">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <button type="button" class="btn btn-warning" onclick="archive({{$document->id}})" data-doc-id="{{$document->id}}" style="color: white; padding: 4px" data-toggle="tooltip" title="Archive">
                                <i class="fa fa-archive"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-success" onclick="sendToSup({{$document->id}})" data-doc-id="{{$document->id}}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Send To Superior">
                                <i class="fa fa-send"></i>
                            </button>
                            <button type="submit" class="btn btn-secondary" style="color: white; padding: 4px" data-toggle="tooltip" title="Print">
                                <i class="fa fa-print"></i>
                            </button>
                        </form>
                        {{--                    <a href="{{ route('users.edit', $document->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&ensp;Edit Document</a>--}}
                    </div>
            </div>
            <div class="card-body" >
                <div class="col-md-12">
                    <h3 class="text-center">{{strtoupper($document->classification->name)}}</h3>
                    <h3 class="text-center">{{strtoupper($document->documentType->name)}}</h3>
                    <h3 class="text-center">{{strtoupper($document->department->name) }}</h3>
                    <h3 class="mb-1 mt-1">Subj: <u><b> {{ $document->subject }} </b></u></h3>

                    <dl class="row">
                        <div class="col-md-12">
                            <dd class="fs-5">{!! $document['body'] !!}</dd>
                        </div>
                    </dl>
                    <dl class="row">
                        <div class="text-center mt-2">
                            <b> <h4> {{\App\Models\Document::documentTitle($document->id)}} </h4></b>
                        </div>
                    </dl>

                    <dl class="row">
                        <div class="text-left mt-2"> <!-- Use text-center class to center the text -->
                          <dd><h4>Signing Authority : {{ \App\Models\User::where('userID', $document->signing_authority_id)->pluck('name')->first() }}</h4></dd>
                        </div>
                    </dl>

                    <dl class="row mt-2">
                        @php $is_info=0; @endphp
                        <div class="col-md-12">
                            @php $is_info=0; @endphp
                            <h5 class="d-inline-block">To:</h5>
                            @if($document->is_allDte == 1)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">All Dte</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @else
                                @foreach($document->recipients as $index=>$recipient)
                                    @if($recipient->type == 'info' || $recipient->name != '' && $recipient->name != null)
                                        @php $is_info=1; @endphp
                                    @endif
                                    @if($recipient->type == 'to')
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">{{ $recipient->name }}</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        @if($is_info==1)
                        <div class="col-md-12">
                            <h5 class="d-inline-block">Info:</h5>
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'info')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 30px">{{ $recipient->name }}</h5>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>
                        @endif
                        <div class="col-md-12">
                            <h5 class="d-inline-block">ID:</h5>
                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">Office Copy</h5><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </dl>
                    <dl>
                        <div class="col-md-12">
                            @foreach($document->attachments as $attachment)
                                <embed src="{{ asset('storage/attachments/' . $attachment->path ) }}" width="100%" height="800px" type="application/pdf">
                            @endforeach
                        </div>
                    </dl>
                    <dl>
                        <div class="col-md-12">
                            @if($document->remarks)
                                @foreach($document->remarks as $remarks)
                                    <h5>From : {{ $remarks->user->name  }}</h5>
                                    <p>Remark : {{ $remarks->remark  }}</p>
                                @endforeach
                            @endif
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <!--/ Page layout -->
    </div>
@endsection
@section('js')
    <script>
        function archive(documentId) {
            $.ajax({
                url: `{{route('documents.archive')}}`,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    documentID: documentId,
                },
                success: function(response) {
                    console.log(response)
                    window.location.href = '{{route('archives.index')}}';
                },
                error: function(error) {
                    console.error('Error archiving document:', error);
                }
            });
        }

        function sendToSup(documentId) {
            $.ajax({
                url: "{{ route('sendDocToSup') }}",
                method: 'get',
                _token: "{{ csrf_token() }}",
                data: { docID: documentId },
                success: function (response) {
                    window.location.href = '{{route('home')}}';
                },
                error: function (error) {
                    // Handle error, e.g., show an error message
                    console.error('Error approving document:', error);
                }
            });
        }
    </script>
@endsection
