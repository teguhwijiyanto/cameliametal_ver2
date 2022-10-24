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
                        <p class="login-box-msg">Register a new membership</p>
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            @error('name')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                            <div class="input-group mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Full name" value="{{old('name')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            @error('employeeId')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                            <div class="input-group mb-3">
                                <input name="employeeId" type="text" class="form-control" placeholder="Employee ID" value="{{old('employeeId')}}">
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
                            <div class="input-group mb-3">
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{url('login')}}" class="text-center">I already have a membership</a>
                    </div>
                </div>
            </div>
        </div>
    </section>    
@endsection
