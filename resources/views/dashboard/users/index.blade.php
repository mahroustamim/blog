@extends('dashboard.layouts.master')

@section('title')
    {{ __('words.users') }}
@endsection

@section('css')
{{-- datatables --}}
<link href="{{ asset('adminasset/assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
{{-- notify --}}
<link rel="stylesheet" href="{{ asset('adminasset/assets/plugins/notify/css/notifIt.css') }}" />
@endsection 


@section('content')

@if (session('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ session('success') }}",
                type: "success"
            });
        }
    </script>
@endif


<div class="card">
    <div class="card-body table-responsive">

      <div class="row mb-3">
        <h4 class="card-title col-9">{{ __('words.users') }}</h4>
        {{-- <a class="col-2 btn btn-primary btn-sm" href="{{ route('dashboard.users.create') }}">{{ __('words.add') . ' ' . __('words.writer') }}</a> --}}
      </div>

      <table class="table table-hover display" id="mahrous" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>{{ __('words.name') }}</th>
            <th>{{ __('words.email') }}</th>
            <th>{{ __('words.status') }}</th>
            <th>{{ __('words.action') }}</th>
          </tr>
        </thead>
        <tbody>

         
        </tbody>
      </table>
    </div>
  </div>

  {{-- delete --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('words.userM2') }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {{-- <form action="dashboard/users/destroy" method="POST"> --}}
      <form action="{{ route('dashboard.users.delete') }}" method="POST">
        
        @csrf
        <div class="modal-body">

          <h5>{{ __('words.userM3') }}</h5>
          <input type="hidden" name="id" id="id" value="">

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">{{ __('words.delete') }}</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('words.cancel') }}</button>
        </div>
      </form>
    </div>
    </div>
  </div>
     


@endsection

@section('scripts')
{{-- datatables --}}
<script src="{{ asset('adminasset/assets/plugins/datatables/datatables.min.js') }}"></script>
{{-- notify --}}
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('adminasset/assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>


    let x;
    @if(config('app.locale') == 'ar')
        x = "_MENU_ كل المدخلات ";
        searchPlaceholder = "ابحث";
        noDataMessage = "لا توجد بيانات متاحة في الجدول";
    @else
        x = "All entries _MENU_ ";
        searchPlaceholder = "Search";
        noDataMessage = "No data available in table";
    @endif

    let table = new DataTable('#mahrous', {
      processing: true,
      serverSide: true,
      responsive: true,
      // accept:"UTF-8",
        pagingType: 'simple_numbers',
        info: false,
        language: {
            lengthMenu: x,
            search: searchPlaceholder + ": ",
            emptyTable: noDataMessage,
        },
        // order: [[1, 'desc']],
        ajax: "{{ route('dashboard.users.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            // {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    //==============================================

    document.addEventListener('DOMContentLoaded', function () {
    var exampleModal = document.getElementById('exampleModal');
    
    exampleModal.addEventListener('show.bs.modal', function (event) {

        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var modalIdInput = exampleModal.querySelector('.modal-body #id');

        modalIdInput.value = id;
    });
});

</script>



@endsection