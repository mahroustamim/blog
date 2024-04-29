<title>@yield('title')</title>
<!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('adminasset/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminasset/assets/vendors/css/vendor.bundle.base.css') }}">

<!-- Layout styles -->
<link rel="stylesheet" href="{{ asset('adminasset/assets/css/style.css') }}">
<!-- End layout styles -->
<link rel="shortcut icon" href="{{ asset($setting->favicon) }}" />

{{-- bootstrap --}}
{{-- <link rel="stylesheet" href="{{ asset('adminasset/assets/plugins/bootstrap-5.3.3/bootstrap.min.css') }}"> --}}



@yield('css')