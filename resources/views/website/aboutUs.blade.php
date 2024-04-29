@extends('website.layout.master')

@section('title')
    {{ __('words.about') }}
@endsection

@section('keywords')
    {{ __('words.about') }}
@endsection

@section('description')
    It is a blog interested in providing Arabic content, especially in the field of information technology.
    Our goal is to be the best and make our blog reach everyone interested in what we do
@endsection

@section('css')
@endsection 


@section('content')

<div class="card">
    <div class="card-body">
        <h4>{{ $setting->title }}</h1>
        <p>
            It is a blog interested in providing Arabic content, especially in the field of information technology.
Our goal is to be the best and make our blog reach everyone interested in what we do
        </p>
    </div>
</div>

@endsection

@section('scripts')

@endsection