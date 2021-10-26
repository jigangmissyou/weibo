@extends('layout.default')
@section('title', 'Rest password')
@section('content')
    <div class="offset-md-1 col-md-10">
        <div class="card">
            <div class="card-header">
                <h5>Reset Password</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route("password.reset")}}">
                    @csrf
                    <input type="hidden" name="token" value="{{token}}">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control{{$errors->has('email')}}">
                        @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('email')}}</strong>
                        </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-6">
                        <input type="password"id="pssword-confirm" class="form-control" name="password">
                    </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
