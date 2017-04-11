<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/prettyPhoto.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/price-range.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ URL::asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
@include('header')
<div class="rev-slider">
    @yield('content')
</div> <!-- .container -->
@include('footer')


<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ URL::asset('js/price-range.js') }}"></script>
<script src="{{ URL::asset('js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>