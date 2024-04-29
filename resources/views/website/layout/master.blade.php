<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', $setting->title)</title>
    <meta name="keywords" content="@yield('keywords', $setting->title)">
    <meta name="description" content="@yield('description', $setting->content)">

    <!-- Favicon -->
    <link href="{{ asset($setting->favicon) }}" rel="icon">

   @include('website.layout.styles')

</head>

<body>

    @include('website.layout.header')





    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                    @yield('content')
                

                    
                </div>

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
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->

    @include('website.layout.footer')

    @include('website.layout.scripts')
</body>

</html>