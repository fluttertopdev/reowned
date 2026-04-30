<!doctype html>
<?php
if (Session()->has('website_locale')) {
    $langCode = Session()->get('website_locale');
} else {
    $langCode = config('app.fallback_locale');
}

$direction = \Helpers::getLanguageDirection($langCode);
?>
<html lang="{{$langCode}}">
<!-- dir="{{$direction }}" -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{url('uploads/setting/'.setting('favicon'))}}" />
  <link rel="stylesheet" href="{{asset('website_assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('website_assets/css/bootstrap.min.css')}}">
  <link href="{{asset('website_assets/css/mobile.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
  <link href="https://unpkg.com/blaze-slider@latest/dist/blaze.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
  <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <title>{{setting('name') ?? 'Reowned'}}</title>
  <script>
    var base_url = "{{url('')}}";
  </script>
</head>

@php
    $user = Auth::guard('web')->user();
    $packageCheck = $user ? \Helpers::canUserPostItem($user->id) : null;
@endphp

<body>
  @include('website.layout.header')

  <!-- BEGIN: Content-->
  @yield('content')
  <!-- END: Content-->

  @include('website.layout.footer')

  @include('website.layout.custom')