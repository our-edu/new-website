<section class="page_main_card">
  <a
    href="{{$videos->first()->video_url}}"
    data-fancybox
    data-type="iframe"
    data-preload="false"
    data-width="740"
    data-height="580">
    <div class="image_overlay"></div>
    <div class="image_wrapper">
        <img src="{{env('APP_URL')."/storage/photos/".$videos->first()->cover_image}}">
      </div>
      <div class="text_overlay">
        <p class="head text-size-24 fw-bold">  {{$videos->first()->title}} </p>
        <p class="title text-size-18 text-color-white"> {{$videos->first()->description}} </p>
      </div>
      <div class="video_icon">
        <img class="play_icon" src="{{asset('front')}}/assets/img/videoicon.png">
      </div>
  </a>
</section>
