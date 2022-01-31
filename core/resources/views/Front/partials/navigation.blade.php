<nav class="navbar navbar-expand-lg {{$transparent}} {{$inverse}} green_nav " id="appNavbar">
  <div class="container p-0">
    <div class="container-fluid p-0">
      <a class="p-0 navbar-brand flex-grow-1" href="/">
        <img src="{{asset('front')}}/assets/img/logo.png" alt="" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav p-0">
          <li class="nav-item  {{request()->routeIs('home') ? "activeLink" :  ""}}">
            <a class="nav-link" aria-current="page" href="{{route('home')}}">
              الرئيسية
            </a>
          </li>
         {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('activities')}}">
              الفاعليات و الانشطة
            </a>
          </li>--}}
          <li class="nav-item {{request()->routeIs('articles') ? "activeLink" :  ""}}">
            <a class="nav-link" href="{{route('articles')}}">
              المقالات
            </a>
          </li>

          <li class="nav-item  {{(request()->routeIs('books')) ? "activeLink" :  ""}}">
            <a class="nav-link" href="{{route('books')}}">
              كتب
            </a>
          </li>
         <li class="nav-item {{(request()->routeIs('videos') || request()->routeIs('gallery')) ? "activeLink" :  ""}}">
            <a class="nav-link" href="{{route('videos')}}">
            صور - فيديو
            </a>
          </li>
          <li class="nav-item  {{(request()->routeIs('profile')) ? "activeLink" :  ""}}">
            <a class="nav-link" href="{{route('profile')}}">
              الملف الشخصي
            </a>
          </li>
        {{--  <li class="nav-item">
            <a class="nav-link" href="{{route('researches')}}">
              درسات و بحوث
            </a>
          </li>--}}
          <li class="nav-item  {{(request()->routeIs('contact_us')) ? "activeLink" :  ""}}">
            <a class="nav-link" href="{{route('contact_us')}}">
              التواصل معنا
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
