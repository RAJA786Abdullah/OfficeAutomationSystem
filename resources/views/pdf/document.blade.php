<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <style>
        @page {
            margin: 1cm; /* Adjust the margin size as needed */
        }
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

        #watermark1 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 20px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;
        }

        #watermark2 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 150px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }

        #watermark3 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 250px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }

        #watermark4 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 350px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }
        #watermark5 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 450px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }

        #watermark6 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 550px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }

        #watermark7 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 650px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }

        #watermark8 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 750px;
            left: 300px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: grey;
            transform: rotate(-20deg);
            opacity: 0.2;
            pointer-events: none;

        }
        .footer{
            position: absolute;
            bottom: 0;
        }

        .bottom-line {
            position: absolute;
            bottom: 25px;
            width: 100%;
            height: 1px;
            background-color: black; /* You can set the color you prefer */
        }

    </style>
</head>
<body>
    <span id="watermark1">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark2">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark3">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark4">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark5">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark6">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark6">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark7">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    <span id="watermark8">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->name}}
    </span>
    @include('pdf.pdf')

    <div class="bottom-line"></div>
    <footer class="footer">
        {{ \App\Models\User::where('userID',$document->signing_authority_id)->pluck('name')->first() }}
    </footer>
</body>
</html>

