<!doctype html>
<html lang="en">

<head>
    <base href="{{ asset('') }}">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    {{-- <link rel="icon" type="image/png" href="https://clipground.com/images/sn-logo-png.png"> --}}

    <!-- Bootstrap core CSS     -->
    <link href="css_copy/dashboard/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="css_copy/dashboard/light-bootstrap-dashboard.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="css_copy/dashboard/pe-icon-7-stroke.css">
    <link href="css_copy/dashboard/nestable.css">
    <link href="css_copy/app.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="https://cdn.tiny.cloud/1/03vjjkv59uvqj4oy2r733miqbkspcof5omxzn0my2lwpia7j/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript"> var editor_config = {
            path_absolute : "http://localhost/doan-laravel-ajax/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);</script>

    <title>Admintrator</title>
    @stack('css')
</head>

<body>

    <div class="wrapper">
        <!-- Menu -->
        @include('layouts.dashboard.menu')
        <div class="main-panel">
            <!-- Header -->
            @include('layouts.dashboard.header')

            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts.dashboard.footer')

        </div>
    </div>


</body>
<!--   Core JS Files  -->
<script src="js_copy/dashboard/jquery.min.js" type="text/javascript"></script>
<script src="js_copy/dashboard/bootstrap.min.js" type="text/javascript"></script>
<script src="js_copy/dashboard/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="js_copy/app.js" type="text/javascript"></script>

<!--  Forms Validations Plugin -->
<script src="js_copy/dashboard/jquery.validate.min.js"></script>
<script src="js_copy/dashboard/nouislider.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="js_copy/dashboard/moment.min.js"></script>

<!--  Date Time Picker Plugin is included in this js file -->
<script src="js_copy/dashboard/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!--  Select Picker Plugin -->
<script src="js_copy/dashboard/bootstrap-selectpicker.js"></script>

<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
<script src="js_copy/dashboard/bootstrap-switch-tags.min.js"></script>

<!--  Charts Plugin -->
<script src="js_copy/dashboard/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="js_copy/dashboard/bootstrap-notify.js"></script>

<!-- Sweet Alert 2 plugin -->
<script src="js_copy/dashboard/sweetalert2.js"></script>


<!-- Vector Map plugin -->
<script src="js_copy/dashboard/jquery-jvectormap.js"></script>

<!-- Wizard Plugin    -->
<script src="js_copy/dashboard/jquery.bootstrap.wizard.min.js"></script>

<!--  Bootstrap Table Plugin    -->
<script src="js_copy/dashboard/bootstrap-table.js"></script>

<!--  Plugin for DataTables.net  -->
<script src="js_copy/dashboard/jquery.datatables.js"></script>


<!--  Full Calendar Plugin    -->
<script src="js_copy/dashboard/fullcalendar.min.js"></script>

<!-- Light Bootstrap Dashboard Core javascript and methods -->
<script src="js_copy/dashboard/light-bootstrap-dashboard.js?v=1.4.1"></script>

<script src="js_copy/dashboard/jquery.nestable.js"></script>

<script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>

@stack('js')

</html>
