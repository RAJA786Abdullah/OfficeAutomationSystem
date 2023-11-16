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
            top: 50px;
            left: 200px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: #c9c9c9;
            transform: rotate(-20deg);
            pointer-events: none;
            user-select: none;
        }


        #watermark5 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 350px;
            left: 200px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: #c9c9c9;
            transform: rotate(-20deg);
            pointer-events: none;
        }

        #watermark8 {
            position: fixed; /* Use fixed position to stay in view when scrolling */
            top: 650px;
            left: 200px;
            width: 100%; /* Full width of the viewport */
            height: 100%; /* Full height of the viewport */
            z-index: 1;
            font-size: 20px;
            color: #c9c9c9;
            transform: rotate(-20deg);
            pointer-events: none;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .bottom-line {
            position: absolute;
            bottom: 40px;
            width: 100%;
            height: 1px;
            background-color: black; /* You can set the color you prefer */
        }

    </style>
</head>
<body>
    <span id="watermark1">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->userCode}}
    </span>

    <span id="watermark5">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->userCode}}
    </span>

    <span id="watermark8">
        {{\Illuminate\Support\Facades\Auth::user()->userCode}} | {{\Illuminate\Support\Facades\Auth::user()->userCode}}
    </span>
    @include('pdf.pdf')

    <div class="bottom-line"></div>
        <footer class="footer d-flex justify-content-center text-center">
            APPROVED BY: {{ \App\Models\User::where('userID',$document->signing_authority_id)->pluck('arm_designation')->first() }} {{ \App\Models\User::where('userID',$document->signing_authority_id)->pluck('name')->first() }}
            <br>
            NOTE: Computer-generated ION does not require a signature.
        </footer>
</body>
</html>

