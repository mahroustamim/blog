@extends('dashboard.layouts.master')

@section('title')
    {{ __('words.posts') }}
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

<form action="{{ route('dashboard.posts.store') }}" method="post" enctype="multipart/form-data">
@csrf

<div class="card mb-5">
    <div class="card-header">
      {{ __('words.posts') }}
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

            <div class="col-6 mb-3">
              <img id="imagePreview" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;">
            </div>

              <div class="col-12 mb-3">
                <label><p>{{ __('words.image') }}</p></label>
                <input type="file" name="image" class="form-control"  aria-label="First name" onchange="previewImage();">
              </div>

              
              <div class="col-12 mb-3">
                <label><p>{{ __('words.status') }}</p></label>
                <select name="category_id" class="form-select" aria-label="Default select example">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
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
                  <input type="text" name="{{ $key }}[title]" class="form-control">
              </div>
              
              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.smallDesc') }}</label>
                <textarea name="{{$key}}[small_desc]" class="form-control" id="editor" cols="30" rows="10" ></textarea>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.content') }}</label>
                <textarea name="{{$key}}[content]" class="form-control" id="editor" cols="30" rows="10" ></textarea>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.tags') }}</label>
                <textarea name="{{$key}}[tags]" class="form-control" id="" cols="30" rows="10" ></textarea>
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
<script src="{{ asset('adminasset/assets/plugins/ckeditor5/ckeditor.js') }}"></script>

{{-- ========================= --}}

<script>

var allEditors = document.querySelectorAll('#editor');

for (var i = 0; i < allEditors.length; i++) {

    ClassicEditor.create(allEditors[i], {
        alignment: {
            options: ['left', 'right', 'center', 'justify']
        }
    }).catch(error => {
        console.error('Error initializing editor:', error);
    });
}

// review image
  function previewImage() {
    const fileInput = document.querySelector('input[type=file]').files[0];
    const preview = document.getElementById('imagePreview');

    if (fileInput) {
      const reader = new FileReader();
      
      reader.onload = function(event) {
        preview.src = event.target.result;
      }

      reader.readAsDataURL(fileInput);
    }
  }

  

</script>

@endsection