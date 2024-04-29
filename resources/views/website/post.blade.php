@extends('website.layout.master')

@section('title')
    {{ __('words.post') }}
@endsection

@section('keywords')
{{ $post->title }}
@endsection

@section('description')
    {{ strip_tags($post->small_desc) }}
@endsection

@section('css')
@endsection 


@section('content')

<div class="position-relative mb-3">
    <img class="img-fluid w-100" src="{{ asset($post->image) }}" style="object-fit: cover; max-height: 400px">
    <div class="overlay position-relative bg-light">
        <div class="mb-3">
            <a href="">{{ $post->category->title }}</a>
            <span class="px-1">/</span>
            <span>{{ $post->created_at->format('Y-m-d') }}</span>
        </div>
        <div>
            <h3 class="mb-3">{{ $post->title }}</h3>
            <p>
                {!! $post->content !!}
            </p>
        </div>
    </div>
</div>
<!-- News Detail End -->

<!-- Comment List Start -->
<div class="bg-light mb-3" style="padding: 30px;">
    <h3 class="mb-4">{{ $commentsCount }} {{ __('words.comments') }}</h3>

    @foreach ($comments as $comment)
    <div class="media mb-4">
        <img src="{{ asset('UserAsset/img/user.png') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
        <div class="media-body">
            <h6><a>{{ $comment->user->name }}</a> <small><i>{{ $comment->created_at->diffForHumans() }}</i></small></h6>
            <p>{{ $comment->comment }}</p>
            @auth
                @if (auth()->user()->id == $comment->user_id)
                    <form action="{{ route('website.comment.delete', $comment->id) }} " method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">delete</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
    @endforeach
    

    
</div>
<!-- Comment List End -->

<!-- Comment Form Start -->
@auth
    <div class="bg-light mb-3" style="padding: 30px;">
        <h3 class="mb-4">{{ __('words.leaveComment') }}</h3>
        <form method="post" action="{{ route('website.comment', $post->id) }}">
            @csrf
            
            <div class="form-group">
                <label for="message">{{ __('words.message') }}</label>
                <textarea name="comment" id="message" cols="30" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group mb-0">
                <input type="submit" value="{{ __('words.leaveComment') }}" class="btn btn-primary font-weight-semi-bold py-2 px-3">
            </div>
        </form>
    </div>
    @endauth
    @guest
        <div>{{ __('words.loginP3') }}</div>
        <a class="btn btn-primary font-weight-semi-bold py-2 px-3" href="{{ route('login') }}">{{ __('words.signIn') }}</a>
    @endguest
<!-- Comment Form End -->
@endsection

@section('scripts')

@endsection