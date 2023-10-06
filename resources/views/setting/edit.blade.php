@extends('layouts.nav')

@section('title', 'Edit Settings')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
{{--                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">Role</a></li>--}}
                        <li class="breadcrumb-item active">Edit Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user"></i> Edit Settings
            </h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('setting.update',Auth::id()) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="col-md-12">
                    {{--Accordion Start--}}
                        <div class="mt-4">
                            <div class="accordion" id="accordionExample">
                                @foreach($customSettings as $key1 => $setting)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne-{{$key1}}">
                                        <button class="accordion-button @if($loop->first) @else collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$key1}}" aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapseOne-{{$key1}}">
                                            {{$key1}}
                                        </button>
                                    </h2>
                                    <div id="collapseOne-{{$key1}}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="headingOne-{{$key1}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{--Tabs Start--}}
                                            <div class="col-12">
                                                <div class="mt-4 mt-xl-0">
                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-pills" role="tablist">
                                                        @foreach($setting as $key2 => $tab)
                                                            <li class="nav-item waves-effect waves-light">
                                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#{{$key2}}" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                    <span class="d-none d-sm-block">{{$key2}}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    <!-- Tab panes -->
                                                    <div class="tab-content p-3 text-muted">
                                                        @foreach($setting as $key2 => $tab)
                                                            <div class="tab-pane @if($loop->first) active @endif" id="{{$key2}}" role="tabpanel">
                                                                @foreach($tab as $key3 => $field)
                                                                    <div class="form-group row">
                                                                        <label for="{{$field->settingCode}}" class="col-sm-2 col-form-label">{{$field->settingName}}</label>
                                                                        <div class="col-sm-10">
                                                                                <input type="hidden" name="settingID" value="{{$field->settingID}}">
                                                                            @switch($field->fieldTypeCode)
                                                                                @case('checkbox')
                                                                                    <input type="hidden" name="{{$field->settingCode}}" value="0">
                                                                                    <input class="form-check" type="{{$field->fieldTypeCode}}" name="{{$field->settingCode}}" value="1" @if($field->settingValue == 1) checked @else  @endif  style="height: 5vh"/>
                                                                                @break
                                                                                @case('radio')
                                                                                <label for="{{$field->settingCode}}" class="col-sm-2 form-check-inline">Yes
                                                                                    <input class="form-check" type="{{$field->fieldTypeCode}}" name="{{$field->settingCode}}" value="1" @if($field->settingValue == 1) checked @endif  style="height: 5vh"/>
                                                                                </label>
                                                                                <label for="{{$field->settingCode}}" class="col-sm-2 form-check-inline">No
                                                                                    <input class="form-check" type="{{$field->fieldTypeCode}}" name="{{$field->settingCode}}" value="0" @if($field->settingValue == 0) checked @endif  style="height: 5vh"/>
                                                                                </label>
                                                                                @break
                                                                                @case('select')

                                                                                @break
                                                                                @default
                                                                                <input class="form-control" type="{{$field->fieldTypeCode}}" name="{{$field->settingCode}}" value="{{$field->settingValue}}" style="height: 5vh"/>
                                                                            @endswitch
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>{{--Tabs END--}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    {{--Accordion END--}}
                    </div>
                <div class="mt-5">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
@endsection
