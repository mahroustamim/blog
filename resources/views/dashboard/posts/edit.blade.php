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

<form action="{{ route('dashboard.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

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

              
              
              <div class="col-6 mb-3">
                <label><p>{{ __('words.image') }}</p></label>
                <img src="{{ asset($post->image) }}" alt="" style="height: 50px">
              </div>

              <div class="col-12 mb-3">
                <label><p>{{ __('words.image') }}</p></label>
                <input type="file" name="image" class="form-control"  aria-label="First name">
              </div>
              
              <div class="col-12 mb-3">
                <label><p>{{ __('words.status') }}</p></label>
                <select name="category_id" class="form-select" aria-label="Default select example">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->title }}</option>
                        {{-- <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->title }}</option> --}}
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
                  <input type="text" name="{{ $key }}[title]" class="form-control" value="{{ $post->translate($key)->title }}">
              </div>
              
              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.smallDesc') }}</label>
                <textarea name="{{$key}}[small_desc]" class="form-control" id="editor" cols="30" rows="10">
                    {{ $post->translate($key)->small_desc }}
                </textarea>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.content') }}</label>
                <textarea name="{{$key}}[content]" class="form-control" id="editor" cols="30" rows="10">
                    {{ $post->translate($key)->content }}
                </textarea>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">{{ __('words.tags') }}</label>
                <textarea name="{{$key}}[tags]" class="form-control" id="" cols="30" rows="10">
                    {{ $post->translate($key)->tags }}
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

</script>

@endsection