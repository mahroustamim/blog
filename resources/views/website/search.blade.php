@extends('website.layout.master')

@section('title')
    {{ __('words.search') }}
@endsection

@section('keywords')

@endsection

@section('description')

@endsection

@section('css')
@endsection 


@section('content')

@if(isset($false)) 
    <div class="bg-light p-5">No result</div>
@endif

<div class="row">
    @foreach ($posts as $post)
    <div class="col-lg-6">
        <div class="position-relative mb-3">
            <img class="img-fluid w-100" src="{{ asset($post->image) }}" style="object-fit: cover; max-height: 250px">
            <div class="overlay position-relative bg-light">
                <div class="mb-2" style="font-size: 14px;">
                    <a class="text-danger">{{ $post->category->title }}</a>
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