<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/logo/logoWhite.jpg">

    <!-- Select 2-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!---Font icons css-->
    <link href="/assets/fonts/fonts/font-awesome.min.css" rel="stylesheet">

    <!-- Data table css -->
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet"/>

    <!-- Date Picker css-->
    <link href="/assets/plugins/date-picker/spectrum.css" rel="stylesheet"/>

    <!---Sweetalert Css-->
    <link href="/assets/plugins/sweet-alert/jquery.sweet-modal.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet"/>

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
        tfoot, thead {
            font-weight: bold;
        }

        #hov:hover {
            background-color: #1753fc;
            color: white;
        }

        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }

        .dataTables_wrapper .dt-buttons {
            float: none;
            text-align: center;
        }
        #rmBgBtn {
            border: none;
            background: none;
            cursor: pointer;
            margin: 0;
            padding: 0;
        }
        .swal-button--confirm {
            background: #7367f0;
        }
        .loginBackground{
            background-image: url('/app-assets/images/pages/back2.jpg');
            /* Control the height of the image */
            min-height: 380px;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .loginCard{
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background-color: rgba(86, 86, 86, 0.5);
            backdrop-filter: blur(9px);
            -webkit-backdrop-filter: blur(9px);
        }
        #watermark {
            position: fixed;
            bottom: 350px;
            left: 200px;
            z-index: -1;
            font-size:30px;
            color: black;
            transform:rotate(-30deg);
            opacity: 0.3
        }
        .content-body{
            opacity: 0.9;
        }

        .custom-col {
            margin-left: 5px;
            padding: 0 10px; /* Adjust the padding as needed */
            border-radius: 10px;
        }

    </style>
    @yield('css')

</head>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static @yield('body-class')" data-open="click" data-menu="vertical-menu-modern" data-col="">
@yield('nav')
<!-- app-content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('main-content')
        @include('partials.message')
</div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-start d-block d-md-inline-block mt-25 @yield('classFooter')">COPYRIGHT &copy; 2023 Defence Housing Authority<span class="d-none d-sm-inline-block">, All rights Reserved Version 1.0</span></span>
    </p>
</footer>
<!-- END: Footer-->
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<!-- Back to top -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
</body>

<!-- Jquery js-->
<script src="/app-assets/js/jquery/jquery.min.js"></script>
<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
{{--<script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>--}}
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- Datepicker js -->
<script src="/assets/plugins/date-picker/spectrum.js"></script>
<script src="/assets/plugins/date-picker/jquery-ui.js"></script>
<script src="/assets/plugins/input-mask/jquery.maskedinput.js"></script>

<!-- Data tables js-->
<script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatable/datatable.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>

<!-- Select2-->
<script src="/app-assets/css/plugins/select2/js/select2.full.min.js"></script>

<!-- Hotkeys-->
<script src="/assets/js/hotkey.js"></script>

<!-- SweetAlert-->
<script src="/app-assets/sweetalert/sweetalert.min.js"></script>

<!-- CK Editor-->
<script src="/app-assets/ckeditor5/build/ckeditor.js"></script>
<script src="/app-assets/ckeditor/ckeditor.js"></script>

<!-- BEGIN: Page JS-->
{{--<script src="/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>--}}
<script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
<script>
    $(document).ready(function () {
        //DataTables
        $('table.display').DataTable({
            "ordering": false,
            "pageLength": 50,
            "initComplete": function(settings, json) {
                // Apply custom styles after DataTable is initialized
                $('table.display').css('font-size', '14px');
                $('table.display th, table.display td').css('padding', '1px');
            }
        });

        //select 2 i.e. search and select.
        $('select.selectTwo').select2({
            dropdownParent: $('.card-body'),
            width: "resolve"
        });

        //alert remove after 8sec
        setTimeout(function () {
            $('.deleteAlert').remove();
        }, 8000);
        $('.toast-close-button').click(function () {
            $('.toast-container').remove();
        });

        //ToolTip
        $('[data-toggle="tooltip"]').tooltip();

        //datepicker
        $("input.datepicker").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: "dd-mm-yy"
        });
    });
</script>
@yield('js')
{{--@include('partials.shortcutKeys')--}}
</html>
