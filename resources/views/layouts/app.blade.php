<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/chartist/css/chartist.css" rel="stylesheet">
    <link href="lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/slim.min.css">

</head>
<body>
@include('inc.header')
    @yield('content')
@include('inc.footer')

<script src="lib/jquery/js/jquery.js"></script>
<script src="lib/popper.js/js/popper.js"></script>
<script src="lib/bootstrap/js/bootstrap.js"></script>
<script src="lib/jquery.cookie/js/jquery.cookie.js"></script>
<script src="lib/chartist/js/chartist.js"></script>
<script src="lib/d3/js/d3.js"></script>
<script src="lib/rickshaw/js/rickshaw.min.js"></script>
<script src="lib/jquery.sparkline.bower/js/jquery.sparkline.min.js"></script>
<script src="lib/select2/js/select2.full.min.js"></script>
<script src="js/ResizeSensor.js"></script>
<script src="js/slim.js"></script>
</body>
</html>
