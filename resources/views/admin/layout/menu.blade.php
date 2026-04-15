<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">

          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#7367F0" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#7367F0" />
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold">{{ __('lang.admin') }}</span>
    </a>


    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->

    <li class="menu-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
      <a href="{{ route('dashboard.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="{{__('lang.admin_menu_dashboard')}}">{{__('lang.admin_menu_dashboard')}}</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.ads_listing')}}">{{__('lang.ads_listing')}}</span>
    </li>


    @can('category')
      <li class="menu-item {{ Request::routeIs('category.index', 'category.form') ? 'active' : '' }}">
        <a href="{{ route('category.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-category-2"></i>
          <div data-i18n="{{__('lang.categories')}}">{{__('lang.categories')}}</div>
        </a>
      </li>
    @endcan


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.item_management')}}">{{__('lang.item_management')}}</span>
    </li>

    @can('tip')
      <li
        class="menu-item {{ Request::is('admin/tips*') || Request::is('admin/create-tips') || Request::is('admin/edit-tips*') ? 'active' : '' }}">
        <a href="{{ url('admin/tips') }}" class="menu-link">
          <i class="menu-icon tf-icons ti  ti-info-circle"></i>
          <div data-i18n="{{__('lang.tips')}}">{{__('lang.tips')}}</div>
        </a>
      </li>
    @endcan

    <li class="menu-item {{ Request::routeIs('item.index') || Request::routeIs('item.form') ? 'active' : '' }}">
      <a href="{{ route('item.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-package"></i>
        <div data-i18n="{{ __('lang.item') }}">{{ __('lang.item') }}</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"
        data-i18n="{{__('lang.customersmanagement')}}">{{__('lang.customersmanagement')}}</span>
    </li>


    @can('customer')
      <li
        class="menu-item {{ Request::routeIs('customer.index', 'customer.form', 'customer.adspackage', 'customer.itempackage', 'customer.userpackage') ? 'active' : '' }}">
        <a href="{{ route('customer.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user-check"></i>
          <div data-i18n="{{__('lang.customers')}}">{{__('lang.customers')}}</div>
        </a>
      </li>
    @endcan

    @can('customer')
      <li
        class="menu-item {{ Request::routeIs('contact_us.index') ? 'active' : '' }}">
        <a href="{{ route('contact_us.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-mail"></i>
          <div data-i18n="{{__('lang.contact_us')}}">{{__('lang.contact_us')}}</div>
        </a>
      </li>
    @endcan


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.sellermanagement')}}">{{__('lang.sellermanagement')}}</span>
    </li>


    @can('seller-verification')
      <li class="menu-item {{ Request::routeIs('seller.index', 'seller.form') ? 'active' : '' }}">
        <a href="{{ route('seller.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-shield-check"></i>
          <div data-i18n="{{__('lang.sellerverification')}}">{{__('lang.sellerverification')}}</div>
        </a>
      </li>
    @endcan

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"
        data-i18n="{{__('lang.package_management')}}">{{__('lang.package_management')}}</span>
    </li>


    @can('advertisementpackage')
      <li
        class="menu-item {{ Request::routeIs('advertisement-package.index') || Request::routeIs('advertisement-package.form') ? 'active' : '' }}">
        <a href="{{ route('advertisement-package.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
          <div data-i18n="{{__('lang.advertisement_package')}}">{{__('lang.advertisement_package')}}</div>
        </a>
      </li>
    @endcan

    @can('itempackage')
      <li
        class="menu-item {{ Request::routeIs('item-listing-package.index') || Request::routeIs('item-listing-package.form') ? 'active' : '' }}">
        <a href="{{ route('item-listing-package.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-package"></i>
          <div data-i18n="{{__('lang.item_listing_package')}}">{{__('lang.item_listing_package')}}</div>
        </a>
      </li>
    @endcan

    <li
      class="menu-item {{ Request::routeIs('userpackage.index') || Request::routeIs('userpackage.form') ? 'active' : '' }}">
      <a href="{{ route('userpackage.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-user-cog"></i>
        <div data-i18n="{{__('lang.userpackages')}}">{{__('lang.userpackages')}}</div>
      </a>
    </li>


    <li
      class="menu-item {{ Request::routeIs('transactions.index') || Request::routeIs('transactions.form') ? 'active' : '' }}">
      <a href="{{ route('transactions.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-credit-card"></i>
        <div data-i18n="{{__('lang.paymenttransactions')}}">{{__('lang.paymenttransactions')}}</div>
      </a>
    </li>

    <!-- Report -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"
        data-i18n="{{__('lang.reports_management')}}">{{__('lang.reports_management')}}</span>
    </li>


    @can('report-reason')
      <li class="menu-item {{ Request::routeIs('reportreason.index', 'reportreason.form') ? 'active' : '' }}">
        <a href="{{ route('reportreason.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-alert-triangle"></i>
          <div data-i18n="{{__('lang.reportreasons')}}">{{__('lang.reportreasons')}}</div>
        </a>
      </li>
    @endcan


    @can('user-report')
      <li class="menu-item {{ Request::routeIs('userreport.index', 'userreport.form') ? 'active' : '' }}">
        <a href="{{ route('userreport.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user-question"></i>
          <div data-i18n="{{__('lang.userreport')}}">{{__('lang.userreport')}}</div>
        </a>
      </li>
    @endcan



    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.staff_management')}}">{{__('lang.staff_management')}}</span>
    </li>


    <li class="menu-item {{ Request::routeIs('role.index') ? 'active' : '' }}">
      <a href="{{ route('role.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-key"></i>
        <div data-i18n="{{__('lang.role_permission')}}">{{__('lang.role_permission')}}</div>
      </a>
    </li>

    <li class="menu-item {{ Request::routeIs('staff.index') || Request::routeIs('staff.form') ? 'active' : '' }}">
      <a href="{{ route('staff.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-user"></i>
        <div data-i18n="{{__('lang.staff')}}">{{__('lang.staff')}}</div>
      </a>
    </li>


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.website_management')}}">{{__('lang.website_management')}}</span>
    </li>

    <li class="menu-item {{ Request::is('admin/banner/edit*') ? 'active' : '' }}">
      <a href="{{ url('admin/banner/edit') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout"></i>
        <div data-i18n="{{__('lang.banner')}}">{{__('lang.banner')}}</div>
      </a>
    </li>


    @can('cms')
      <li
        class="menu-item {{ Request::is('admin/cms*') || Request::is('admin/create-cms') || Request::is('admin/edit-cms*') ? 'active' : '' }}">
        <a href="{{ url('admin/cms') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file"></i>
          <div data-i18n="{{__('lang.cms')}}">{{__('lang.cms')}}</div>
        </a>
      </li>
    @endcan


    @can('faq')
      <li class="menu-item {{ request()->routeIs('faq.*') ? 'active' : '' }}">
        <a href="{{ route('faq.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-help-circle"></i>
          <div data-i18n="{{__('lang.faq')}}">{{__('lang.faq')}}</div>
        </a>
      </li>
    @endcan

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"
        data-i18n="{{__('lang.language_management')}}">{{__('lang.language_managementlanguage_management')}}</span>
    </li>

    @can('language')
      <li class="menu-item {{ Request::is('admin/language*') || Request::is('admin/translation*') ? 'active' : '' }}">
        <a href="{{ route('language.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-language"></i>
          <div data-i18n="{{__('lang.language')}}">{{__('lang.language')}}</div>
        </a>
      </li>
    @endcan


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"
        data-i18n="{{__('lang.setting_management')}}">{{__('lang.setting_management')}}</span>
    </li>

    <li class="menu-item {{ (Request::is('admin/setting*', 'admin/seo*')) ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="tf-icons ti ti-settings"></i>
        <div data-i18n="{{__('lang.setting')}}">{{__('lang.setting')}}</div>
        <div class="badge bg-primary rounded-pill ms-auto"></div>
      </a>
      <ul class="menu-sub">

        @can('setting')
          <li class="menu-item {{ Request::is('admin/setting*') ? 'active' : '' }}">
            <a href="{{ route('setting.index') }}" class="menu-link">
              <div data-i18n="{{__('lang.all_setting')}}">{{__('lang.all_setting')}}</div>
            </a>
          </li>
        @endcan

      </ul>
    </li>



  </ul>
</aside>