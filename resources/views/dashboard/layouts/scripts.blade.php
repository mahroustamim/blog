<!-- plugins:js -->
<script src="{{ asset('adminasset/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('adminasset/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('adminasset/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('adminasset/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('adminasset/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('adminasset/assets/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('adminasset/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('adminasset/assets/js/todolist.js') }}"></script>

<!-- jQuery -->
{{-- <script src="{{ asset('adminasset/assets/js/jquery-3.7.1.min.js') }}"></script> --}}
<!-- Bootstrap JS -->
{{-- <script src="{{ asset('adminasset/assets/plugins/bootstrap-5.3.3/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminasset/assets/plugins/bootstrap-5.3.3/bootstrap.bundle.min.js') }}"></script> --}}



<!-- End custom js for this page -->
@yield('scripts')