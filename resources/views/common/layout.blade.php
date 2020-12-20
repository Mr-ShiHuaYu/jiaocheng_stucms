<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('lib/layui-v2.5.5/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/public.css')}}" media="all">
    @yield('css')
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        @yield('content')
    </div>
</div>
<script src="{{asset('lib/layui-v2.5.5/layui.js')}}" charset="utf-8"></script>
<script src="{{asset('js/lay-config.js')}}" charset="utf-8"></script>
@yield('js')
</body>
</html>
