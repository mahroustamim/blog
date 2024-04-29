  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row align-items-center bg-light px-lg-5">
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between">
                <div class="bg-primary text-white text-center py-2" style="width: 100px;">{{ __('words.tranding') }}</div>
                <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                    @foreach ($lastFivePosts as $post)
                        <div class="text-truncate"><a class="text-secondary" href="{{ route('website.post', $post->id) }}">{{ $post->title }}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 text-right d-none d-md-block">
            {{ date('D, Y-m-d') }}
        </div>
    </div>
    <div class="row align-items-center py-2 px-lg-5">
        <div class="col-lg-4">
            <a href="" class="navbar-brand d-none d-lg-block">
                <img src="{{ asset($setting->logo) }}" alt="logo" style="height: 50px;">
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <img class="img-fluid" src="img/ads-700x70.jpg" alt="">
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid p-0 mb-3">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('website.home') }}" class="nav-item nav-link active">{{ __('words.home') }}</a>

                @foreach ($categories as $category)
                    <div class="nav-item dropdown">
                        <a href="{{ route('website.category', $category->id) }}" class="nav-link @if($category->children->isNotEmpty()) dropdown-toggle @endif"  @if($category->children->isNotEmpty()) data-toggle="dropdown"@endif>{{ $category->title }}</a>
                        @if ($category->children->isNotEmpty())
                            <div class="dropdown-menu rounded-0 m-0">

                                @foreach ($category->children as $child) 
                                    <a href="{{ route('website.category', $child->id) }}" class="dropdown-item">{{ $child->title }}</a>
                                @endforeach

                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        {{ __('words.language') }}
                    </a>
                    <div class="dropdown-menu rounded-0 m-0">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                
                <a href="{{ route('website.about') }}" class="nav-item nav-link ">{{ __('words.aboutUs') }}</a>

                @auth
                    @if (auth()->user()->status == 'admin')
                    <a href="{{ route('dashboard.home') }}" class="nav-item nav-link ">{{ __('words.dashboard') }}</a>
                    @endif
                @endauth

            
            </div>

            <form action="{{ route('website.search') }}">
                <div class="input-group ml-auto me-5" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control" name="search" placeholder="{{ __('words.search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text text-secondary"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <span class="text-light">.....</span>

            @auth
            <a href="{{ route('website.setting', auth()->user()->id) }}" class=" btn btn-primary">{{ __('words.settings') }}</a>
            @endauth


            @guest
                <a href="{{ route('login') }}" class=" btn btn-danger">{{ __('words.signIn') }}</a>
                <span class="text-light">...</span>
                <a href="{{ route('register') }}" class=" btn btn-danger">{{ __('words.register') }}</a>
            @endguest

            
        </div>
    </nav>
</div>
<!-- Navbar End -->