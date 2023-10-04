<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        .container{
            display: flex;
            justify-content: center;
        }
        .d-flex{
            display: flex;
        }
        .justify-content-center{
             justify-content: center;
        }
        .align-items-center{
            align-items: center;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .d-inline-block{
            display: inline-block;
        }
        .d-inline{
            display: inline;
        }
        .my-2{
            margin-bottom: 5px;
        }
        .body{
            padding: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
                <h3 class="text-center">
                    <u>
                        {{ strtoupper(trim($document->classification->name)) }} <br>
                        {{ strtoupper(trim($document->documentType->name))  }} <br>
                        {{ '('.strtoupper(trim($document->department->name)) .')' }}
                    </u>
                </h3>

        </div>
        <h3 class="mb-1 mt-1">Subj: <u><b> {{ $document->subject }} </b></u></h3>
        <div class="body">
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
</body>
</html>
