<div class="layout-page">
  <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-md"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
          <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">

          </a>
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Language -->
        <li class="nav-item dropdown-language dropdown">
          <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
            href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="ti ti-language rounded-circle ti-md"></i>
          </a>
          <?php
            $langList = \Helpers::getAllLangList();

            if (Session()->has('admin_locale')) {
              $langCode = Session()->get('admin_locale');
            } else {
              $langCode = config('app.fallback_locale');
            }
          ?>

          <ul class="dropdown-menu dropdown-menu-end">
            @if(count($langList) > 0)
              @foreach($langList as $langRow)
                <li>
                  <a class="dropdown-item" href="{{ route('setting.setLanguage', ['lang' => $langRow->code]) }}"
                    data-languages="{{$langRow->code }} ">
                    <span class="align-middle">{{ $langRow->name }}</span>
                  </a>
                </li>
              @endforeach
            @endif
          </ul>
        </li>
        <!--/ Language -->

        <!-- Style Switcher -->
        <li class="nav-item dropdown-style-switcher dropdown">
          <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
            href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="ti ti-md"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                <span class="align-middle"><i class="ti ti-sun ti-md me-3"></i>{{ __('lang.light') }}</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>{{ __('lang.dark') }}</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                <span class="align-middle"><i class="ti ti-device-desktop-analytics ti-md me-3"></i>{{ __('lang.system') }}</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- / Style Switcher-->

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar">
              <img src="{{ url('uploads/user/' . Auth::guard('admin')->user()->image)}}" alt class="rounded-circle" onerror="this.onerror=null;this.src=`{{ asset('uploads/default-user.png') }}`"/>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item mt-0" href="{{route('admin.profile')}}">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0 me-2">
                    <div class="avatar">
                      <img src="{{ url('uploads/user/' . Auth::guard('admin')->user()->image)}}" alt class="rounded-circle" onerror="this.onerror=null;this.src=`{{ asset('uploads/default-user.png') }}`"/>
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="mb-0">{{Auth::guard('admin')->user()->name}}</h6>

                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider my-1 mx-n2"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{route('admin.profile')}}">
                <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">{{__('lang.my_profile')}}</span>
              </a>
            </li>
            <li>
              <div class="d-grid px-2 pt-2 pb-1">
                <a class="btn btn-sm btn-danger d-flex" href="{{ url('admin/adminlogout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <small class="align-middle">{{__('lang.logout')}}</small>
                  <i class="ti ti-logout ms-2 ti-14px"></i>
                </a>
                <form id="logout-form" action="{{route('admin.logout')}}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
      <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
        aria-label="Search..." />
      <i class="ti ti-x search-toggler cursor-pointer"></i>
    </div>
  </nav>


  <div id="imageZoomModal" class="image-modal" onclick="closeImageModal()">
    <span class="close">&times;</span>
    <img class="image-modal-content" id="modalImage">
  </div>