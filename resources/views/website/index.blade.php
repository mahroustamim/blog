<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> {{ $setting->title }} </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $setting->title }}" name="keywords">
    <meta content="{{ $setting->content }}" name="description">

    <!-- Favicon -->
    <link href="{{ asset($setting->favicon) }}" rel="icon">

    @include('website.layout.styles')
</head>

<body>
    
    @include('website.layout.header')


    <!-- Top News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">

                @foreach ($lastFivePosts as $post)
                    <div class="d-flex">
                        <img src="{{ asset($post->image) }}" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="{{ route('website.post', $post->id) }}">{{ $post->title }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Top News Slider End -->


    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">

                        @foreach ($topPosts as $post)
                            <div class="position-relative overflow-hidden" style="height: 435px;">
                                <img class="img-fluid h-100" src="{{ asset($post->image) }}" style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-1">
                                        <a class="text-white" href="{{ route('website.category', $post->category->id) }}">{{ $post->category->title }}</a>
                                        <span class="px-2 text-white">/</span>
                                        <a class="text-white">{{ $post->created_at->format('Y-m-d') }}</a>
                                    </div>
                                    <a class="h2 m-0 text-white font-weight-bold" href="{{ route('website.post', $post->id) }}">{{ $post->title }}</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">{{ __('words.categories') }}</h3>
                    </div>

                    @foreach ($categories as $category)
                        <div class="position-relative overflow-hidden mb-3" style="height: 80px;">
                            <img class="img-fluid w-100 h-100" src="{{ asset($category->image) }}" style="object-fit: cover;">
                            <a href="{{ route('website.category', $category->id) }}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                {{ $category->title }}
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


   

    <!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            @foreach ($categoriesWithPosts as $category)
                @if ($category->posts->isNotEmpty())
                    <div class="col-lg-6 py-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">{{ $category->title }}</h3>
                        </div>

                        <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                            @foreach ($category->posts as $post)
                                <div class="position-relative" style="overflow: hidden;">
                                    <img class="img-fluid w-100" src="{{ asset($post->image) }}" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="{{ route('website.category', $category->id) }}">{{ $category->title }}</a>
                                            <span class="px-1">/</span>
                                            <span>{{ $post->created_at->format('Y-m-d') }}</span>
                                        </div>
                                        <a class="h4 m-0" href="{{ route('website.post', $post->id) }}" style="white-space: nowrap;">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Category News Slider End -->



    


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                
                
                
                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">{{ __('words.followUs') }}</h3>
                        </div>
                        <div class="d-flex mb-3">
                            @if (!empty($setting->facebook))
                                <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                                    <small class="fab fa-facebook-f mr-2"></small><small>{{ __('words.joinUs') }}</small>
                                </a>
                            @endif

                            @if (!empty($setting->instagram))
                                <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                                    <small class="fab fa-instagram mr-2"></small><small>{{ __('words.joinUs') }}</small>
                                </a>
                            @endif
                            
                        </div>
                       
                    </div>
                    <!-- Social Follow End -->

                    

                    <!-- Ads Start -->
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid" src="{{ asset('UserAsset/img/news-500x280-4.jpg') }}" alt=""></a>
                    </div>
                    <!-- Ads End -->

                </div>
                <div class="col-8">
                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">{{ __('words.tranding') }}</h3>
                        </div>

                        @foreach ($lastFivePosts as $post)
                        <div class="d-flex mb-3">
                            <img src="{{ asset($post->image) }}" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{ route('website.category', $post->category->id) }}">{{ $post->category->title }}</a>
                                    <span class="px-1">/</span>
                                    <span>{{ $post->created_at->format('Y-m-d') }}</span>
                                </div>
                                <a class="h6 m-0" href="{{ route('website.post', $post->id) }}">{{ $post->title }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Popular News End -->
                </div>
                   
                {{-- </div> --}}
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->


    @include('website.layout.footer')

    @include('website.layout.scripts')
    
</body>

</html>