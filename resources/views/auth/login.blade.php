<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .bg-danger {
            background-color: #dc3545 !important; /* Redefine Bootstrap primary color to danger */
        }
        .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        .input-danger:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">Login</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="input-danger form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="{{ __('words.email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="input-danger form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="{{ __('words.password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">{{ __('words.remember') }}</label>
                            </div>
                            
                            <button type="submit" class="btn btn-danger">{{ __('words.login') }}</button>
                            <div class="mt-3">{{ __('words.account') }}<a href="{{ route('register') }}">{{ __('words.register') }}</a></div>
                              {{-- <div class=""> {{ __('words.account') }} <a href="{{ route('register') }}" class="text-primary">{{ __('words.register') }}</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
