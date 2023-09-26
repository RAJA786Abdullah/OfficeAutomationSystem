@extends('layouts.nav')
@section('title', 'User Show')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Document</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('documents.index')}}">Documents</a>
                        </li>
                        <li class="breadcrumb-item active">Document
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Page layout -->
    <div class="card p-3">
        <div class="card-header">
            <h3 class="mb-0 card-title"><i class="fa fa-user"></i> {{ $document->id }}</h3>
            @can('user_update')
                <a href="{{route('users.edit',$document->id)}}" class="btn btn-primary ml-auto">
                    <i class="fa fa-plus"></i>&ensp;Edit Document
                </a>
            @endcan
        </div>
            <div class="card-body">
                <div class="col-md-12">
                    <h3 class="text-center mb-1 mt-1">{{ strtoupper($document->classification->name) }}</h3>
                    <h3 class="text-center mb-1 mt-1">{{ strtoupper($document->documentType->name) }}</h3>
                    <h3 class="text-center mb-1 mt-1">{{ '('.strtoupper($document->department->name) .')' }}</h3>
                    <h3 class="mb-1 mt-1">Subj: <u> <b> {{ $document->subject }} </b> </u></h3>
                    <h3 class="mb-1 mt-1">Signing Authority: <u> <b> {{ $document->singing_authority_id }} </b> </u></h3>

                    <dl class="row">
                        <div class="col-md-12">
                            <dd class="fs-5">{!! $document['body'] !!}</dd>
                        </div>
                    </dl>


                    <dl class="row">
                        <div class="col-md-12 text-center mt-2">
                         <b> <h4> {{\App\Models\Document::documentTitle($document->id)}} </h4></b>
                        </div>
                    </dl>
                    <dl class="row mt-3">
                        <div class="col-md-12">
                            <h5 class="d-inline-block">To:</h5>
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'to')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">{{ $recipient->name }}</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <h5 class="d-inline-block">Info:</h5>
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'info')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 30px">{{ $recipient->name }}</h5>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-12">
                            <h5 class="d-inline-block">ID:</h5>
                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">Office Copy</h5><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </dl>



                </div>
            </div>

{{--                    <div class="col-md-12">--}}
{{--                        <h5 class="text-center mb-3">Purchase Orders</h5>--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-bordered table-hover table-striped">--}}
{{--                                <thead class="thead-dark">--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Product Name</th>--}}
{{--                                    <th scope="col">Warehouse</th>--}}
{{--                                    <th scope="col">Code</th>--}}
{{--                                    <th scope="col">Quantity</th>--}}
{{--                                    <th scope="col">Batch Number</th>--}}
{{--                                    <th scope="col">Expiry Date</th>--}}
{{--                                    <th scope="col">Net Unit Cost</th>--}}
{{--                                    <th scope="col">Discount</th>--}}
{{--                                    <th scope="col">Tax</th>--}}
{{--                                    <th scope="col">Total</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($purchaseOrders as $order)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $order->product->name }}</td>--}}
{{--                                        <td>{{ $order->warehouse->name }}</td>--}}
{{--                                        <td>{{ $order->code }}</td>--}}
{{--                                        <td>{{ $order->quantity }}</td>--}}
{{--                                        <td>{{ $order->batchNumber ?? '' }}</td>--}}
{{--                                        <td>{{ $order->expiryDate ?? '' }}</td>--}}
{{--                                        <td>{{ $order->netUnitCost }}</td>--}}
{{--                                        <td>{{ $order->discount }}</td>--}}
{{--                                        <td>{{ $order->tax }}</td>--}}
{{--                                        <td>{{ $order->subTotal }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                    <div class="col-md-12">--}}
{{--                        <h5 class="text-center mb-3">Purchase Receive</h5>--}}
{{--                        <div class="table-responsive">--}}

{{--                            <table class="table table-bordered">--}}
{{--                                <thead class="thead-dark">--}}
{{--                                <tr>--}}
{{--                                    <th>Product Name</th>--}}
{{--                                    <th>Received Quantity</th>--}}
{{--                                    <th>Date</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($purchaseReceives as $receive)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $receive->product->name }}</td>--}}
{{--                                        <td>{{ $receive->receivedQty }}</td>--}}
{{--                                        <td>{{ \Carbon\Carbon::parse($receive->date)->format('Y-m-d')  }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--            <table class="table-sm table-striped text-nowrap w-100 display">--}}
{{--                <tbody class="col-lg-6 p-0">--}}
{{--                <tr>--}}
{{--                    <td><strong>User Name :</strong> {{ $user->name}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><strong>Email :</strong> <a href="mailto:{{ $user->email}}">{{ $user->email}}</a></td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--                <tbody class="col-lg-6 p-0">--}}
{{--                <tr>--}}
{{--                    <td><strong>User Type :</strong> {{ $user->userType->userType}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><strong>Date Created :</strong> {{ $user->dateCreated}}</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
    </div>
    <!--/ Page layout -->
</div>
@endsection
