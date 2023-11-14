@section('title',\App\Models\Document::documentTitle($document->id))
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <h3 class="text-center">
            <u>
                {{ strtoupper(trim($document->classification->name)) }} <br>
                {{ strtoupper(trim($document->documentType->name))  }} <br>
                {{'('.strtoupper(trim($document->department->name)).')'}}
            </u>
        </h3>
    </div>
    <h3 class="mb-1 mt-1">Subj: <u><b> {{ $document->subject }} </b></u></h3>
    <div class="body" style="padding-right: 10px; width: 100%;">
        {!! $document['body'] !!}
    </div>
    <div class="text-right">
        <h4 style="text-align: right">
            @if($signInData)
                @foreach($signInData as $index => $signIn)
                    @if($loop->last)
                        <p style="margin: 0;">{{ '('.$signIn.')' }}</p>
                    @else
                        <p style="margin: 0;">{{ $signIn }}</p>
                    @endif
                @endforeach
            @endif
        </h4>
    </div>
    <div class="text-center">
        <u><b><h4>{{\App\Models\Document::documentTitle($document->id)}}</h4></b></u>
    </div>
    <div class="to my-2">
        <div class="d-inline-block">To:</div>
        @foreach($recipientTo as $key => $to)
            @if($key==1)
                <div class="d-inline-block" style="margin-left: 22px">{{ $to->name }}</div>
            @else
                <div style="margin-left: 50px">{{ $to->name }}</div>
            @endif
        @endforeach
    </div>
    <div class="info my-2">
        <div class="d-inline-block">Info:</div>
        @foreach($recipientInfo as $key => $info)
            @if($key==0)
                <div class="d-inline-block" style="margin-left: 15px">{{ $info->name }}</div>
            @else
                <div style="margin-left: 50px">{{ $info->name.$key }}</div>
            @endif
        @endforeach
    </div>
    <div class="officeCopy">
        <div class="d-inline-block">ID:</div>
        <div class="d-inline-block" style="margin-left: 25px">Office Copy</div>
    </div>
</div>
