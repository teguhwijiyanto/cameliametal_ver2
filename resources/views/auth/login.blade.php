@extends('auth.templates.default')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="register-box">
                <div class="register-logo">
                    <a href="{{url('/')}}"><b>Camelia Metal</b></a>
                </div>
                <div class="card">
                    <div class="card-body register-card-body">
                        <p class="login-box-msg">Login Form</p>
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            @error('employeeId')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                            <div class="input-group mb-3">
                                <input name="employeeId" type="text" class="form-control" placeholder="Employee Id" value="{{old('employeeId')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                            <div class="input-group mb-3">
                                <input name="password" type="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                            </div>
                            <a href="{{route('register')}}" class="text-center">You are a new user?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    
@endsection
