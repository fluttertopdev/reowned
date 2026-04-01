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

    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-8 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="../../assets/img/illustrations/auth-login-illustration-light.png"
            alt="auth-login-cover"
            class="my-5 auth-illustration"
            data-app-light-img="illustrations/auth-login-illustration-light.png"
            data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

          <img
            src="../../assets/img/illustrations/bg-shape-image-light.png"
            alt="auth-login-cover"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-12 pt-5">
          @if(Session::has('error'))
          <div class="alert alert-danger" role="alert" style="padding: 15px;">
            {{ Session::get('error') }}
          </div>
          @endif
          @if(Session::has('success'))
          <div class="alert alert-success" role="alert" style="padding: 15px;">
            {{ Session::get('success') }}
          </div>
          @endif
          <h4 class="mb-1">{{__('lang.admin_login')}}</h4>
          <p class="mb-6"> {{__('lang.login')}}</p>

          <form id="login-form" class="mb-6" action="{{route('login.dologin')}}" method="POST">
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
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">{{__('lang.password')}}</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>

              </div>
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="my-8">
              <div class="d-flex w-100">
                <div class="ms-auto text-end">
                  <a href="{{route('forgotpassword.index')}}">
                    <p class="mb-0">{{__('lang.forgot_password')}}</p>
                  </a>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">{{__('lang.login')}}</button>
          </form>





        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>


</body>

</html>