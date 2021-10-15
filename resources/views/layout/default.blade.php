<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', '微博 APP')</title>
    <link rel="stylesheet" href="/css/app.css") }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">微博APP</a>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item"><a class="nav-link" href="{{route('help')}}">帮助</a> </li>
            <li class="nav-item"><a class="nav-link" href="{{route('about')}}">关于</a> </li>
        </ul>
    </div>
</nav>
@yield('content')
</body>
</html>
<?php
