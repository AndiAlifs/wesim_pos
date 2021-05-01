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
                    <h3><a href="" class=""><b>Register </b>| WESIM</a></h3>
                </div>
                <!-- /.login-logo -->
                <div class="px-5 py-2">
                    <div class="login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="Email" value="{{ old('email') }}" required autocomplete="email"
                                    autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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
                                    name="password" placeholder="Password" autocomplete="new-password" required>
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

                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password" autocomplete="new-password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- ------------- --}}
                            <div class="row p-2">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember"
                                        {{ old('remember') ? 'checked' : '' }} required>
                                    <label for="remember">
                                        Setuju dengan <a href="#" class="">Ketentuan</a>
                                    </label>
                                </div>
                            </div>
                            <div class="row px-2">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fab user-plus"></i> Register
                                </button>
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
                            <a href="" class="text-secondary">Already a member</a>
                            <br>
                            {{-- <a href="" class="text-center">Register a new membership</a> --}}
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="username"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        required autocomplete="new-username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
