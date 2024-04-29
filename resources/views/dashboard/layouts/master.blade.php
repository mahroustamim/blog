{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $setting->content }}">
    <meta name="keyword" content="{{ $setting->title }}">

    @include('dashboard.layouts.style')

  </head>
  <body>

    @include('dashboard.layouts.header')

      <div class="container-fluid page-body-wrapper">

      @include('dashboard.layouts.sidebare')

      <div class="main-panel">
        <div class="content-wrapper">
          
        @yield('content')

      </div>
    </div>

    @include('dashboard.layouts.scripts')
  </body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $setting->content }}">
    <meta name="keyword" content="{{ $setting->title }}">

    @include('dashboard.layouts.style')

  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      @include('dashboard.layouts.header')


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('dashboard.layouts.sidebare')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            

            @yield('content')
            
            
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('dashboard.layouts.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('dashboard.layouts.scripts')
  </body>
</html>