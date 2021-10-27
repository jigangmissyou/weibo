@extends('layout.default')
@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <h4>微博列表</h4>
                <hr>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
                <section class="stats mt-2">
                    @include('shared._stats', ['user'=>Auth::user()])
                </section>
                    <section class="status_form">
                        @foreach($users as $user)
                            @include('users._follow_form')
                        @endforeach
                    </section>
            </aside>
        </div>
    @else
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <p class="lead">
            This is a website built by laravel.
        </p>
        <p>Everything begins here.</p>
        <p class="btn btn-lg btn-success" href="#" role="button">Register</p>
    </div>
    @endif
@stop
