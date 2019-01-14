<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shards Dashboard Lite - Free Bootstrap Admin Template – DesignRevision</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/admin/files/all.css" rel="stylesheet">
    <link href="/admin/files/google.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/files/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="/admin/styles/shards-dashboards.1.1.0.min.css">
    <link rel="stylesheet" href="/admin/styles/extras.1.1.0.min.css">
    @yield('css')
</head>
<body class="h-100">

<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            @include('admin.layouts.navbar')
            <!-- / .main-navbar -->
                @yield('content')
            @include('admin.layouts.footer')
        </main>
    </div>
</div>
<div class="promo-popup animated">
    <a href="http://bit.ly/shards-dashboard-pro" class="pp-cta extra-action">
        <img src="https://dgc2qnsehk7ta.cloudfront.net/uploads/sd-blog-promo-2.jpg"> </a>
    <div class="pp-intro-bar"> Need More Templates?
        <span class="close">
          <i class="material-icons">close</i>
        </span>
        <span class="up">
          <i class="material-icons">keyboard_arrow_up</i>
        </span>
    </div>
    <div class="pp-inner-content">
        <h2>Shards Dashboard Pro</h2>
        <p>A premium & modern Bootstrap 4 admin dashboard template pack.</p>
        <a class="pp-cta extra-action" href="http://bit.ly/shards-dashboard-pro">Download</a>
    </div>
</div>

<script src="/js/app.js"></script>
<script src="/admin/js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="/admin/shards.min.js"></script>
<script src="/admin/jquery.sharrre.min.js"></script>
<script src="/admin/scripts/extras.1.1.0.min.js"></script>
<script src="/admin/scripts/shards-dashboards.1.1.0.min.js"></script>
<script src="/admin/scripts/app/app-blog-overview.1.1.0.js"></script>
<script src="/sweetalert.min.js"></script>

@if(session()->has('editAlert'))
    <script>
        swal({
            title: "{{session('editAlert.title')}}",
            icon: "success",
            button: "Ok!",
        });
    </script>

    @elseif(session()->has('createAlert'))
    <script>
        swal({
            title: "{{session('createAlert.title')}}",
            icon: "success",
            button: "Ok!",
        });
    </script>
@elseif(session()->has('warningAlert'))
    <script>
        swal({
            title: "{{session('warningAlert.title')}}",
            icon: "warning",
            button: "Cancel!",
        });
    </script>
@endif

@yield('js')
</body>
</html>