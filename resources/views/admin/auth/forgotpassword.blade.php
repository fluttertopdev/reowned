<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{__('lang.admin_login')}}</title>

  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/favicon/favicon.ico')}}" />




  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/fontawesome.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/tabler-icons.css')}}" />


  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
  <!-- Page CSS -->

  <link rel="stylesheet" href="{{asset('/assets/vendor/css/pages/page-auth.css')}}" />



</head>

<body>

  <div class="authentication-wrapper authentication-cover">
    <!-- Logo -->

    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-8 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="{{asset('assets/img/illustrations/auth-forgot-password-illustration-light.png')}}"
            alt="auth-forgot-password-cover"
            class="my-5 auth-illustration d-lg-block d-none"
            data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
            data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />

          <img
            src="{{asset('assets/img/illustrations/bg-shape-image-light.png')}}"
            alt="auth-forgot-password-cover"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Forgot Password -->
      <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-12 mt-5">
          @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          <h4 class="mb-1">{{__('lang.forgot_password')}} 🔒</h4>
          <p class="mb-6">{{__('lang.forgot_password_text')}}</p>
          <form id="formAuthentication" class="mb-6" action="{{route('password.forgot')}}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="email" class="form-label">{{__('lang.email')}}</label>
              <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="{{__('lang.email')}}"
                autofocus />
              <input type="hidden" name="type" value="admin">
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">{{__('lang.submit')}}</button>
          </form>
          <div class="text-center">
            <a href="{{route('login.index')}}" class="d-flex align-items-center justify-content-center">
              <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
              {{__('lang.back_to_login')}}
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</body>

</html>