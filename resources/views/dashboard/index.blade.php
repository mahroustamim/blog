@extends('dashboard.layouts.master')

@section('title')
    الرئيسية
@endsection

@section('css')
@endsection 

@section('content')


      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{ asset('adminasset/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">{{ __('words.users') }} <i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">
                {{ $users }}
              </h2>
              <h6 class="card-text">
              @if($usersPercent > 0)
              <h6 class="card-text">{{ __('words.increased') }} {{ number_format($usersPercent, 2) }}%</h6>
              @elseif($usersPercent < 0)
                <h6 class="card-text">{{ __('words.decreased') }} {{ number_format(abs($usersPercent), 2) }}%</h6>
              @else
                <h6 class="card-text">{{ __('words.noChange') }}</h6>
              @endif
              </h6>
            </div>
          </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="{{ asset('adminasset/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">{{ __('words.posts') }} <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">
                {{ $posts }}
              </h2>
              <h6 class="card-text">
              @if($postsPercent > 0)
              <h6 class="card-text">{{ __('words.increased') }} {{ number_format($postsPercent, 2) }}%</h6>
              @elseif($postsPercent < 0)
                <h6 class="card-text">{{ __('words.decreased') }} {{ number_format(abs($postsPercent), 2) }}%</h6>
              @else
                <h6 class="card-text">{{ __('words.noChange') }}</h6>
              @endif
              </h6>
            </div>
          </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="{{ asset('adminasset/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">{{ __('words.visitsNumber') }}<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5">
                {{ $visits }}
              </h2>
              @if($visitPercent > 0)
              <h6 class="card-text">{{ __('words.increased') }} {{ number_format($visitPercent, 2) }}%</h6>
              @elseif($visitPercent < 0)
                <h6 class="card-text">{{ __('words.decreased') }} {{ number_format(abs($visitPercent), 2) }}%</h6>
              @else
                <h6 class="card-text">{{ __('words.noChange') }}</h6>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-6 bg-light">
          <div class="card-body">
            {!! $pie->render() !!}
          </div>
        </div>

          <div class="col-6 bg-light">
            <div class="card-body">
              {!! $bar->render() !!}
            </div>
          </div>

      </div>

     

@endsection

@section('scripts')

@endsection