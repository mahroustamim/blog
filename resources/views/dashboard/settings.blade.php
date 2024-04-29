@extends('dashboard.layouts.master')

@section('title')
    {{ __('words.settings') }}
@endsection

@section('css')
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

<form action="{{ route('dashboard.settings.update', 1) }}" method="post" enctype="multipart/form-data">
  @method('PUT')
@csrf

<div class="card mb-5">
    <div class="card-header">
      {{ __('words.settings') }}
    </div>

    <div class="card-body">
      <blockquote class="blockquote">

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif
            
          <div class="row">

            <div class="col-md-6">
              <label><p>{{ __('words.logo') }}</p></label>
              <img src="{{asset($setting->logo)}}" alt="" style="height: 50px">
            </div>  
            <div class="col-md-6">
                <label><p>{{ __('words.favicon') }}</p></label>
                <img src="{{asset($setting->favicon)}}" alt="" style="height: 50px">
            </div>


              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.logo') }}</p></label>
                <input type="file" name="logo" class="form-control"  aria-label="First name">
              </div>

              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.favicon') }}</p></label>
                <input type="file" name="favicon" class="form-control"  aria-label="Last name">
              </div>
              
              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.facebook') }}</p></label>
                <input type="text" name="facebook" class="form-control" aria-label="Last name" value="{{ $setting->facebook }}">
              </div>

              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.instagram') }}</p></label>
                <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}">
              </div>

              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.phone') }}</p></label>
                <input type="text" name="phone" class="form-control" aria-label="Last name" value="{{ $setting->phone }}">
              </div>

              <div class="col-12 col-lg-6 mb-3">
                <label><p>{{ __('words.email') }}</p></label>
                <input type="text" name="email" class="form-control" value="{{ $setting->email }}">
              </div>

            </div>
            {{-- end row --}}
            <blockquote>
          </div> 
    {{-- end card body --}}

  </div> 
  {{-- end card --}}

  <div class="card">
    <div class="card-header">
      {{ __('words.translations') }}
    </div>

    <div class="card-body"> 

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach (config('app.languages') as $key => $lang)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if ($loop->first) active @endif" id="{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab" aria-controls="{{ $key }}" aria-selected="@if ($loop->first) true @else false @endif">
                {{ $lang }}
            </button>
        </li>
        @endforeach
    </ul>
    
    <div class="tab-content" id="myTabContent">
        @foreach (config('app.languages') as $key => $lang)
        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab" tabindex="0">
            <div class="row mt-4 mb-4">

              <div class="col-12 mb-3">
                  <label class="form-label">{{ __('words.title') }} - {{ $lang }}</label>
                  <input type="text" name="{{ $key }}[title]" class="form-control" value="{{ $setting->translate($key)->title }}">
              </div>
              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.content') }}</label>
                <textarea name="{{$key}}[content]" class="form-control" cols="30" rows="10">
                  {{ $setting->translate($key)->content }}
                </textarea>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.address') }}</label>
                <textarea name="{{$key}}[address]" class="form-control" cols="30" rows="10">
                  {{ $setting->translate($key)->address }}
                </textarea>
              </div>

            </div>
        </div>
        @endforeach
    </div>
    
      

    </div>
    {{-- end card body --}}
  </div>
  {{-- end card --}}

  <button type="submit" class="btn btn-gradient-primary btn-icon-text mt-4">
    <i class="mdi mdi-file-check btn-icon-prepend"></i> Submit </button>
</form>

@endsection

@section('scripts')
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection