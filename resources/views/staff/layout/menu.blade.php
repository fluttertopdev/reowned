<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">

          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#7367F0" />
          <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
            fill="#161616" />
          <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
            fill="#161616" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#7367F0" />
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold">Staff</span>
    </a>


    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->

    <li class="menu-item {{ Route::is('staffdashboard.index') ? 'active' : '' }}">
      <a href="{{ route('staffdashboard.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="{{__('lang.admin_menu_dashboard')}}">{{__('lang.admin_menu_dashboard')}}</div>
      </a>
    </li>



    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.ads_listing')}}">{{__('lang.ads_listing')}}</span>
    </li>

 @if (in_array('category', \Helpers::staffgetAssignedPermissions()))
    <li class="menu-item {{ Request::routeIs('staffCategory.index', 'staffCategory.form') ? 'active' : '' }}">
        <a href="{{ route('staffCategory.index') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-category-2"></i>
            <div data-i18n="{{__('lang.categories')}}">{{__('lang.categories')}}</div>
        </a>
    </li>
    @endif

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.package_management')}}">{{__('lang.package_management')}}</span>
    </li>


  @if (in_array('advertisementpackage', \Helpers::staffgetAssignedPermissions()))
    <li class="menu-item {{ Request::routeIs('staffAdvertisementpackage.index') || Request::routeIs('staffAdvertisementpackage.form') ? 'active' : '' }}">
      <a href="{{ route('staffAdvertisementpackage.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-chart-bar"></i>
        <div data-i18n="{{__('lang.advertisement_package')}}">{{__('lang.advertisement_package')}}</div>
      </a>
    </li>
  @endif
    @if (in_array('itempackage', \Helpers::staffgetAssignedPermissions()))
    <li class="menu-item {{ Request::routeIs('staffitemPackages.index') || Request::routeIs('staffitemPackages.form') ? 'active' : '' }}">
      <a href="{{ route('staffitemPackages.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-package"></i>
        <div data-i18n="{{__('lang.item_listing_package')}}">{{__('lang.item_listing_package')}}</div>
      </a>
    </li>
     @endif

        <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.promotional_management')}}">{{__('lang.promotional_management')}}</span>
    </li>


    @if (in_array('notification', \Helpers::staffgetAssignedPermissions()))
    <li class="menu-item {{ Request::routeIs('staffNotification.index', 'staffNotification.form') ? 'active' : '' }}">
      <a href="{{ route('staffNotification.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-bell"></i>
        <div data-i18n="{{__('lang.send_notification')}}">{{__('lang.send_notification')}}</div>
      </a>
    </li>
      @endif
 <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="{{__('lang.queries')}}">{{__('lang.queries')}}</span>
    </li>


@if (in_array('user-queries', \Helpers::staffgetAssignedPermissions()))
    <li class="menu-item {{ Request::routeIs('staffuserqueries.index', 'staffuserqueries.form') ? 'active' : '' }}">
      <a href="{{ route('staffuserqueries.index') }}" class="menu-link">
       <i class="menu-icon tf-icons ti ti-message-circle"></i>

        <div data-i18n="{{__('lang.userqueries')}}">{{__('lang.userqueries')}}</div>
      </a>
    </li>
  @endif


 </ul>
</aside>






    

    




   



    


    







   


   


    


    
   

  





    




   

    

    

   
    







    


 