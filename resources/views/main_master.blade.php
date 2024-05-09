<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Dashboard | Theme Looks</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- DEMO CHARTS -->
    <link rel="stylesheet" href="{{ asset('assets/demo/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/demo/chartist-plugin-tooltip.css') }}">
    <!-- Template -->
    <link rel="stylesheet" href="{{ asset('assets/graindashboard/css/graindashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
<!-- Header -->
@include('body.header')
<!-- End Header -->

<main class="main">
    <!-- Sidebar Nav -->
   @include('body.side_bar')
    <!-- End Sidebar Nav -->

    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/graindashboard/js/graindashboard.js') }}"></script>
<script src="{{ asset('assets/graindashboard/js/graindashboard.vendor.js') }}"></script>

<!-- DEMO CHARTS -->
<script src="{{ asset('assets/demo/resizeSensor.js') }}"></script>
<script src="{{ asset('assets/demo/chartist.js') }}"></script>
<script src="{{ asset('assets/demo/chartist-plugin-tooltip.js') }}"></script>
<script src="{{ asset('assets/demo/gd.chartist-area.js') }}"></script>
<script src="{{ asset('assets/demo/gd.chartist-bar.js') }}"></script>
<script src="{{ asset('assets/demo/gd.chartist-donut.js') }}"></script>
<script>
    $.GDCore.components.GDChartistArea.init('.js-area-chart');
    $.GDCore.components.GDChartistBar.init('.js-bar-chart');
    $.GDCore.components.GDChartistDonut.init('.js-donut-chart');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':

            toastr.options.timeOut = 10000;
            toastr.info("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();
            break;
        case 'success':

            toastr.options.timeOut = 10000;
            toastr.success("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
        case 'warning':

            toastr.options.timeOut = 10000;
            toastr.warning("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
        case 'error':

            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
    }
    @endif
</script>
</body>
</html>
