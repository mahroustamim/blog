@extends('dashboard.layouts.master')

@section('title')
    {{ __('words.categories') }}
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

<form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="card mb-5">
    <div class="card-header">
      {{ __('words.categories') }}
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
                <label><p>{{ __('words.image') }}</p></label>
                <img src="{{asset($category->image)}}" alt="" style="height: 50px">
            </div>

            <div class="col-12 mb-3">
                <label><p>{{ __('words.image') }}</p></label>
                <input type="file" name="image" class="form-control"  aria-label="First name">
            </div> 

              <div class="col-12 mb-3">
                <label><p>{{ __('words.section') }}</p></label>
                <select name="parent" class="form-select" aria-label="Default select example">
                    <option value="0" {{ $category->parent === 0 ? 'selected' : '' }}>{{ __('words.mainCategory') }}</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{ $category->parent == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                    @endforeach
                  </select>
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
                  <input type="text" name="{{ $key }}[title]" class="form-control"  value="{{ $category->translate($key)->title }}">
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.content') }}</label>
                <textarea name="{{$key}}[content]" class="form-control" cols="30" rows="10" value="{{ $category->translate($key)->content }} "></textarea>
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
    <i class="mdi mdi-file-check btn-icon-prepend"></i> {{ __('words.save') }} </button>
</form>

@endsection

@section('scripts')
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection