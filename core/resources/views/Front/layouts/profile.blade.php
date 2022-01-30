<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title}}</title>
  @yield('meta')
  <!-- favicon -->
  @include('Front.partials.styles')
  @yield('styles')

</head>

<body>
  <!--PreLoader-->
  <div class="loader">
    <div class="loader-inner">
      <div class="circle"></div>
    </div>
  </div>
  <!--PreLoader Ends-->
  @include('Front.partials.navigation',["transparent"=>"", "inverse"=>""])
  <main class="" role="main">
    @yield('content')
  </main>
  @include('Front.partials.footer')
  <script src="{{asset('front')}}/assets/js/main.js"></script>

</body>

</html>
