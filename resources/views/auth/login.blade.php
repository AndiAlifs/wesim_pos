@extends('layouts.app')

@section('content')
    <style>
        /* #2793c2 */
        #bg {
            height: 92vh;
            min-width: 30vw;
            background-image: url(http://localhost:8000/image/bg/photo1.png);
            background-position: center;
            /* background-repeat: no-repeat; */
            background-size: cover;
        }

    </style>
    <div class="container p-0">
        <div class="row justify-content-center">
            <div class="col" id="bg"></div>
            {{-- <img class=" col-8" src="http://localhost:8000/image/bg/photo1.png" alt="" id="bg"> --}}
            <div class="col-4 login-box p-0 pt-5" style="min-width: 400px;">
                <div class="login-logo text-center pt-4">
                    <h3><a href="" class=""><b>Login </b>| WESIM</a></h3>
                </div>
                <!-- /.login-logo -->
                <div class="p-5">
                    <div class="login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" placeholder="Username" value="{{ old('username') }}" required
                                    autocomplete="username" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
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
    </div>
@endsection
