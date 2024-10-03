<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ asset('adminasset/assets/images/faces/face1.jpg') }}" alt="profile">
            <span class="login-status online"></span>
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">Mahrous</span>
            <span class="text-secondary text-small">{{ __('words.manager') }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.home') }}">
          <span class="menu-title">{{ __('words.dashboard') }}</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      
      <li class="nav-item">
        @can('viewAny', App\Models\User::class)
          <a class="nav-link" href="{{ route('dashboard.users.index') }}">
            <span class="menu-title">{{ __('words.users') }}</span>
            <i class="mdi mdi-account-multiple menu-icon"></i>
          </a>
        @endcan
      </li>
      <li class="nav-item">
        @can('viewAny', App\Models\User::class)
          <a class="nav-link" href="{{ route('dashboard.writer') }}">
            <span class="menu-title">{{ __('words.writer') }}</span>
            <i class="mdi mdi-account-star menu-icon"></i>
          </a>
        @endcan
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.categories.index') }}">
          <span class="menu-title">{{ __('words.categories') }}</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.posts.index') }}">
          <span class="menu-title">{{ __('words.posts') }}</span>
          <i class="mdi mdi-newspaper menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        @can('is_admin')
          <a class="nav-link" href="{{ route('dashboard.settings.index') }}">
            <span class="menu-title">{{ __('words.settings') }}</span>
            <i class="mdi mdi-settings menu-icon"></i>
          </a>
          @endcan
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('website.home') }}">
            <span class="menu-title text-secondary">{{ __('words.website') }}</span>
            <i class="mdi mdi-web menu-icon text-secondary"></i>
          </a>
        </li>

    
      
    </ul>
  </nav>