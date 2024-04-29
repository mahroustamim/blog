@extends('dashboard.layouts.master')

@section('title')
    {{ __('words.users') }}
@endsection

@section('css')

{{-- notify --}}
<link rel="stylesheet" href="{{ asset('adminasset/assets/plugins/notify/css/notifIt.css') }}" />

@endsection 


@section('content')
@if (session('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ session('success') }}",
                type: "success"
            });
        }
    </script>
@endif


<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">{{ __('words.edit') }}</h4>

        <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" class="needs-validation" novalidate>

            @csrf
            @method('PUT')

            <div class="row mb-3">

                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">{{ __('words.name') }}:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}"  autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">{{ __('words.email') }}:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">{{ __('words.password') }}:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="confirm_password" class="form-label">{{ __('words.confirmPassword') }}:</label>
                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" >
                </div>

            </div>
            
            <button type="submit" class="btn btn-primary">{{ __('words.save') }}</button>
        </form>
    </div>
</div>




@endsection

@section('scripts')

{{-- notify --}}
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifit-custom.js') }}"></script>

@endsection