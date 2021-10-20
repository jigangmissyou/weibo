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
            @if(Auth::check())
            <li class="nav-item"><a class="nav-link" href="{{route('help')}}">用户列表</a> </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdown">{{Auth::user()->name}}</a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('users.show', Auth::user())}}"></a>
                <a class="dropdown-item" href="#">编辑资料</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="logout" href="#">
                <form action="{{route('logout')}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                </form>
                </a>
            </div>
            </li>
            @else
            <li class="nav-item"><a class="nav-link" href="{{route('help')}}">帮助</a> </li>
                @endif
        </ul>
    </div>
</nav>
@include('shared._message')
@yield('content')
<script src="../../js/app.js"></script>
</body>
</html>
<?php
