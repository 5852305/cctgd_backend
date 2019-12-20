<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>虫虫特工队管理后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="{{ asset("images/favicon.ico") }}">
    @include("admin.layout2.css")
    @yield("css")
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="app" class="{{ route_class() }}-page">
<div class="layuimini-container">
    <div class="layuimini-main">
            @yield("content")
    </div>
</div>


@include("admin.layout2.js")
@yield("js")
</body>
</html>
