   <!-- Footer Start -->
   <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
    <div class="row">

        <div class="col-6 mb-5">
            <a href="index.html" class="navbar-brand">
                <img src="{{ asset($setting->logo) }}" alt="logo" style="height: 50px;">
            </a>
            <p>{{ $setting->content }}</p>
            
            <div class="d-flex justify-content-start mt-4">
                @if (!empty($setting->facebook))
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                @endif

                @if (!empty($setting->instagram))
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>
        <div class="col-6 mb-5">
            <h4 class="font-weight-bold mb-4">{{ __('words.categories') }}</h4>
            <div class="d-flex flex-wrap m-n1">
                @foreach ($categories as $category)
                    <a href="{{ route('website.category', $category->id) }}" class="btn btn-sm btn-outline-secondary m-1">{{ $category->title }}</a>
                @endforeach
            </div>
        </div>
        
       
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center">
        &copy; <a class="font-weight-bold" href="{{ route('website.home') }}">{{ $setting->title }}</a>.{{ __('words.allRights') }}. 
        
        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        {{ __('words.designedBy') }} <a class="font-weight-bold" >{{ __('words.mahrous') }}</a>
    </p>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>

