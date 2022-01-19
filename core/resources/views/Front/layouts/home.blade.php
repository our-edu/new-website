<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <!-- favicon -->
@include('Front.partials.styles')
@yield('styles')
  <!-- endbuild -->
</head>

<body>
  <!--PreLoader-->
  <div class="loader">
    <div class="loader-inner">
      <div class="circle"></div>
    </div>
  </div>
  <!--PreLoader Ends-->
{{--  {{> navigation transparent="transparent" inverse="inverse"}}--}}
  @include('Front.partials.navigation',["transparent"=>"transparent", "inverse"=>"inverse"])

  <div class="" role="main">
{{--    {{> body}}--}}
    @yield('content')
  </div>
  @include('Front.partials.footer')
  <script src="{{asset('front')}}/assets/js/main.js"></script>
  <script src="{{asset('front')}}/assets/js/home.js"></script>
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</body>

</html>
