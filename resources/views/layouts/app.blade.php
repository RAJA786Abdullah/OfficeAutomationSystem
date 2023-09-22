<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

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
    <link href="/assets/plugins/iconfonts/plugin.css" rel="stylesheet"/>
    <link href="/assets/plugins/iconfonts/icons.css" rel="stylesheet"/>
    <link href="/assets/fonts/fonts/font-awesome.min.css" rel="stylesheet">

    <!-- Data table css -->
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet"/>

    <!-- Date Picker css-->
    <link href="/assets/plugins/date-picker/spectrum.css" rel="stylesheet"/>

    <!---Sweetalert Css-->
    <link href="/assets/plugins/sweet-alert/jquery.sweet-modal.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

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
        <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2024 <a href="https://www.dhaquetta.org/">Defence Housing Authority</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
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

<!-- DataTables Export Buttons-->
<script src="/app-assets/datatableExportButtons/dataTables.buttons.min.js"></script>
<script src="/app-assets/datatableExportButtons/buttons.html5.min.js"></script>
<script src="/app-assets/datatableExportButtons/jszip.min.js"></script>
<script src="/app-assets/datatableExportButtons/pdfmake.min.js"></script>
<script src="/app-assets/datatableExportButtons/vfs_fonts.js"></script>
<!-- Select2-->
<script src="/app-assets/css/plugins/select2/js/select2.full.min.js"></script>

<!-- Hotkeys-->
<script src="/assets/js/hotkey.js"></script>

<!-- SweetAlert-->
<script src="/app-assets/sweetalert/sweetalert.min.js"></script>

<!-- CK Editor-->
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

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
            dom: 'lBfrtip',
            "pageLength": 50,
            buttons: [
                // {
                //     extend: 'excelHtml5',
                //     text: 'Export To Excel',
                //     className: 'btn-primary',
                //     exportOptions: {columns: ':not(.notExport)'}
                // },
                // {
                //     extend: 'pdfHtml5',
                //     text: 'Export To PDF',
                //     className: 'btn-secondary',
                //     exportOptions: {columns: ':not(.notExport)'}
                // }
            ],
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
