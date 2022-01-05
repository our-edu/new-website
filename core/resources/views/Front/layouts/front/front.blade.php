<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta
            name="description"
            content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/"
    />
    @yield('metaTags')
    @include('Front.layouts.front.partials.styles')
    @yield('styles')
    <title>@yield('title')</title>

</head>
<body>
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
@yield('header')

@yield('content')

@yield('footer')
@include('Front.layouts.front.partials.scripts')
@yield('scripts')


</body>
</html>