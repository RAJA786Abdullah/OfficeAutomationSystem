@extends('layouts.app')
@section('nav')
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-fluid">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item">
                        <a class="nav-link menu-toggle" href="{{route('home')}}"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ ucfirst(Auth::user()->name) }}</span><span class="user-status">{{ ucfirst(Auth::user()->roles[0]->roleName) }}</span>
                        </div>
                        <span class="avatar"><img src="/app-assets/images/logo/logoWhite.jpg" width="30px" height="30px" alt="logo"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
{{--                        <a class="dropdown-item" href="{{ route('settings.edit',Auth::id()) }}"><i class="me-50" data-feather="settings"></i> Settings</a>--}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <span class="brand-logo">
                            <img src="/app-assets/images/logo/logoWhite.jpg" width="40px" height="40px" alt="logo">
                        </span>
                        <h2 class="brand-text">O A S</h2>
                    </a></li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                {{-- Dashboard --}}
                @can('dashboard_read')
                <li class=" nav-item" aria-haspopup="true">
                    <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'home') active @endif" href="{{route('home')}}">
                        <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
                    </a>
                </li>
                @endcan

                {{-- Branches --}}
                @can('branch_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'branches.index'|| request()->route()->action['as'] == 'branches.create' || request()->route()->action['as'] == 'branches.edit' || request()->route()->action['as'] == 'branches.show') active @endif" href="{{route('branches.index')}}">
                            <i class="ti ti-binary-tree"></i></i><span class="menu-title text-truncate" data-i18n="Branches">Branches</span>
                        </a>
                    </li>
                @endcan

                {{-- Departments --}}
                @can('department_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'departments.index'|| request()->route()->action['as'] == 'departments.create' || request()->route()->action['as'] == 'departments.edit' || request()->route()->action['as'] == 'departments.show') active @endif" href="{{route('departments.index')}}">
                            <i class="ti ti-building"></i><span class="menu-title text-truncate" data-i18n="Departments">Departments</span>
                        </a>
                    </li>
                @endcan

                {{-- Files --}}
                @can('files_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'files.index'|| request()->route()->action['as'] == 'files.create' || request()->route()->action['as'] == 'files.edit' || request()->route()->action['as'] == 'files.show') active @endif" href="{{route('files.index')}}">
                            <i class="ti ti-briefcase"></i><span class="menu-title text-truncate" data-i18n="files">Files</span>
                        </a>
                    </li>
                @endcan

                {{-- Classifications --}}
                @can('classification_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'classifications.index'|| request()->route()->action['as'] == 'classifications.create' || request()->route()->action['as'] == 'classifications.edit' || request()->route()->action['as'] == 'classifications.show') active @endif" href="{{route('classifications.index')}}">
                            <i class="ti ti-layout-grid"></i><span class="menu-title text-truncate" data-i18n="classifications">Classifications</span>
                        </a>
                    </li>
                @endcan

                {{-- Document Types --}}
                @can('document_type_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'document_types.index'|| request()->route()->action['as'] == 'document_types.create' || request()->route()->action['as'] == 'document_types.edit' || request()->route()->action['as'] == 'document_types.show') active @endif" href="{{route('document_types.index')}}">
                            <i data-feather="file"></i><span class="menu-title text-truncate" data-i18n="Document Types">Document Types</span>
                        </a>
                    </li>
                @endcan

                {{-- Documents --}}
                @can('dashboard_read')
                    <li class=" nav-item" aria-haspopup="true">
                        <a class="d-flex align-items-center @if(request()->route()->action['as'] == 'documents.index'|| request()->route()->action['as'] == 'documents.create' || request()->route()->action['as'] == 'documents.edit' || request()->route()->action['as'] == 'documents.show') active @endif" href="{{route('documents.index')}}">
                            <i class="ti ti-files"></i><span class="menu-title text-truncate" data-i18n="Documents">Documents</span>
                        </a>
                    </li>
                @endcan

                {{-- Admin --}}
                @can('user_read')
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Admin</span></a>
                        <ul class="menu-content">
                            <li class=" nav-item" aria-haspopup="true">
                                <a class="d-flex align-items-center @if( request()->route()->action['as'] == 'role.index' || request()->route()->action['as'] == 'role.create' || request()->route()->action['as'] == 'role.edit' || request()->route()->action['as'] == 'role.show' ) active @endif" href="{{route('role.index')}}">
                                    <i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="Home">Roles</span>
                                </a>
                            </li>

                            <li class=" nav-item" aria-haspopup="true">
                                <a class="d-flex align-items-center @if( request()->route()->action['as'] == 'users.index' || request()->route()->action['as'] == 'users.create' || request()->route()->action['as'] == 'users.edit' || request()->route()->action['as'] == 'users.show' ) active @endif" href="{{route('users.index')}}">
                                    <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Home">Users</span>
                                </a>
                            </li>

                            <li class=" nav-item" aria-haspopup="true">
                                <a class="d-flex align-items-center @if( request()->route()->action['as'] == 'audit.index' ) active @endif" href="{{route('audit.index')}}">
                                    <i class="ti ti-history"></i><span class="menu-title text-truncate" data-i18n="Audit">Audit</span>
                                </a>
                            </li>

{{--                            <li class=" nav-item" aria-haspopup="true">--}}
{{--                                <a id="front-end-link" class="d-flex align-items-center" href="{{ route('gotoFrontEnd') }}">--}}
{{--                                    <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Home">Front End</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            {{--                        <li class=" nav-item" aria-haspopup="true">--}}
                            {{--                            <a class="d-flex align-items-center @if( request()->route()->action['as'] == 'setting') active @endif" href="{{route('setting.edit',Auth::id())}}"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Setting">Settings</span></a>--}}
                            {{--                        </li>--}}
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            function frontEnd(){
                console.log('yes');
            }

            // $('#front-end-link').click(function(e) {
            //     console.log('yes');
            //     // e.preventDefault();
            //     window.location.href = '/resources/views/front-end/home';
            // });
        });

    </script>
@endsection
