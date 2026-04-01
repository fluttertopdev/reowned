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

    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-8 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="../../assets/img/illustrations/auth-reset-password-illustration-light.png"
            alt="auth-reset-password-cover"
            class="my-5 auth-illustration"
            data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
            data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png" />

          <img
            src="../../assets/img/illustrations/bg-shape-image-light.png"
            alt="auth-reset-password-cover"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Reset Password -->
      <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-6 p-sm-12">
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
          <h4 class="mb-1">{{__('lang.reset_password')}} 🔒</h4>
          <p class="mb-6">
            <span class="fw-medium">{{__('lang.reset_password_text')}}</span>
          </p>
          <form id="formAuthentication" class="mb-6" action="{{route('password.doreset')}}" method="POST">
            @csrf
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">{{__('lang.enter_otp')}}</label>
              <div class="input-group input-group-merge">
                <input
                  type="text"
                  id=""
                  class="form-control"
                  name="otp"
                  placeholder="{{__('lang.enter_otp')}}"
                  aria-describedby="" />

              </div>
              @error('otp')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="new-password">{{ __('lang.new_password') }}</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="new-password"
                  class="form-control"
                  name="password"
                  placeholder="••••••••••••"
                  aria-describedby="new-password" />
                <span class="input-group-text cursor-pointer toggle-password">
                  <i class="ti ti-eye-off"></i>
                </span>
              </div>
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="confirm-password">{{ __('lang.confirm_password') }}</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="confirm-password"
                  class="form-control"
                  name="password_confirmation"
                  placeholder="••••••••••••"
                  aria-describedby="confirm-password" />
                <span class="input-group-text cursor-pointer toggle-password">
                  <i class="ti ti-eye-off"></i>
                </span>
              </div>
              @error('cpassword')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button class="btn btn-primary d-grid w-100 mb-6">{{__('lang.set_new_password')}}</button>
            <div class="text-center">
              <a href="{{route('login.index')}}">
                <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                {{__('lang.back_to_login')}}
              </a>
            </div>
          </form>
        </div>
      </div>
      <!-- /Reset Password -->
    </div>
  </div>

</body>

</html>
<script>
  document.querySelectorAll('.toggle-password').forEach(function(el) {
    el.addEventListener('click', function() {
      const input = this.previousElementSibling;
      const icon = this.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('ti-eye-off');
        icon.classList.add('ti-eye');
      } else {
        input.type = 'password';
        icon.classList.remove('ti-eye');
        icon.classList.add('ti-eye-off');
      }
    });
  });
</script>