@extends('website.layout.master')

@section('title')
    {{ __('words.settings') }}
@endsection

@section('keywords')
{{ __('words.settings') }}, logout, delete
@endsection

@section('description')
    you can edit or delete account or logout
@endsection

@section('css')
@endsection 


@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">{{ __('words.edit') }}</h4>

        <form action="{{ route('website.setting.update', $user->id) }}" method="post" class="needs-validation" novalidate>

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


<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">{{ __('words.logout') }}</h4>
        <a class="btn btn-outline-primary" href="{{ route('logout') }}" 
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('words.logout') }} </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">{{ __('words.delete') }} {{ __('words.Account') }}</h4>
        <form action="{{ route('website.setting.delete', $user->id) }}" method="post">
            @csrf
            <input type="submit" value="{{ __('words.delete') }}" class="btn btn-outline-primary">
        </form>
    </div>
</div>
@endsection

@section('scripts')

@endsection