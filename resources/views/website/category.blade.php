@extends('website.layout.master')

@section('title')
    {{ __('words.category') }}
@endsection

@section('keywords')
{{ $category->title }}
@endsection

@section('description')
{{ $category->content }}
@endsection

@section('css')
@endsection 

@section('content')



<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
            <h3 class="m-0">{{ $category->title }}</h3>
        </div>
    </div>
    @foreach ($posts as $post)
    <div class="col-lg-6">
        <div class="position-relative mb-3">
            <img class="img-fluid w-100" src="{{ asset($post->image) }}" style="object-fit: cover; max-height: 250px">
            <div class="overlay position-relative bg-light">
                <div class="mb-2" style="font-size: 14px;">
                    <a class="text-danger">{{ $category->title }}</a>
                    <span class="px-1">/</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <a class="h4" href="{{ route('website.post', $post->id) }}">{{ $post->title }}</a>
                <p class="m-0">{!! $post->small_desc !!}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
    
    
    
<div class="d-flex justify-content-center">
    {!! $posts->links() !!}
</div>

@endsection

@section('scripts')

@endsection