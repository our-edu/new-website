{{--{{!-- This is the base layout for your project, and will be used on every page. --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <!-- favicon -->
@include('Front.partials.styles')

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
{{--  {{> navigation}}--}}
  @include('Front.partials.navigation')

  <main class="layout_wrapper" role="main">
{{--    {{> body}}--}}
    @yield('content')

  </main>
{{--  {{> footer}}--}}
  @include('Front.partials.footer')


  <script src="{{asset('front')}}/assets/js/main.js"></script>
  <script src="{{asset('front')}}/assets/js/default.js"></script>
</body>

</html>
