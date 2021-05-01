@extends('layouts.app')

@section('content')
    <style>
        /* #2793c2 */
        #bg {
            height: 92vh;
            /* background-image: url(http://localhost:8000/image/bg/photo1.png); */
            /* background-position: left; */
            /* background-repeat: no-repeat; */
            /* background-size: cover; */
        }

    </style>
    <div class="container p-0">
        <div class="row justify-content-center">
            <img class=" col-8" src="http://localhost:8000/image/bg/photo1.png" alt="" id="bg">
            <div class="login-box col-4 p-0 pt-5">
                <div class="login-logo text-center py-3">
                    <h3><a href="" class=""><b>Login </b>| WESIM</a></h3>
                </div>
                <!-- /.login-logo -->
                <div class="p-5">
                    <div class="">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="Username" value="{{ old('username') }}" required
                                    autocomplete="username" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" autocomplete="current-password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            {{-- <a href="#" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                            <a href="#" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a> --}}
                        </div>
                        <!-- /.social-auth-links -->

                        <p class="mb-1 text-secondary text-center">
                            <a href="" class="text-secondary">I forgot my password</a>
                            <br>
                            {{-- <a href="" class="text-center">Register a new membership</a> --}}
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        </img>
    @endsection
