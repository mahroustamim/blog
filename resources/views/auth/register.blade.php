<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-danger {
            background-color: #dc3545 !important; /* Redefine Bootstrap primary color to danger */
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .input-danger:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-header bg-danger text-white">Register</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('words.name') }}</label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror input-danger" id="name" name="name" placeholder="{{ __('words.name') }}" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('words.email') }}</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror input-danger" id="exampleInputEmail1" name="email" placeholder="{{ __('words.email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{ __('words.password') }}</label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror input-danger" id="exampleInputPassword1" name="password" placeholder="{{ __('words.password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ __('words.confirmPassword') }}</label>
                                <input type="password" class="form-control form-control-lg input-danger" id="password-confirm" name="password_confirmation" placeholder="{{ __('words.confirmPassword') }}">
                            </div>
                            <button type="submit" class="btn btn-danger">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
