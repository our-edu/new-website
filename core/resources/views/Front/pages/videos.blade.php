@extends('Front.layouts.default',['title'=>"contact"])
@section('content')
<div class="videos container">
  <div class="d-flex justify-content-between toggle_images-videos">
    <h1 class="pageDescription">
      <a href="/gallery">الصور</a>
    </h1>
    </h1>
    <h1 class="toggle_active pageDescription">
      <a href="/videos">الفيديوهات</a>
    </h1>
  </div>


{{--  {{> videosMainCard textHead=data.videos.head textTitle=data.videos.title }}--}}
  @include('Front.partials.videosMainCard')


  <section class="more_videos">
    <div class="row">
      <div class="col-sm-12 mb-5 col-lg-6">
        <a href="https://www.youtube.com/watch?v=govmXpDGLpo&ab_channel=AutomationStepbyStep"
          data-fancybox data-type="iframe" data-preload="false" data-width="740" data-height="580">
          <div class="video_wrapper">
            <img src="{{asset('front')}}/assets/img/image%203.png" />
            <img class="play_icon" src="{{asset('front')}}/assets/img/videoicon.png">
            <p class="video_text">محاضرة قراه في تاريخنا الوطني</p>
            <div class="image_overlay"></div>
          </div>
        </a>
      </div>
      <div class="col-sm-12 mb-5 col-lg-6">
          <div class="video_wrapper">
            <video width="320" height="240" controls>
              <source src="movie.mp4" type="video/mp4">
            </video>
            <p class="video_text">محاضرة قراه في تاريخنا الوطني</p>
            <div class="image_overlay"></div>
          </div>
      </div>
      <div class="col-sm-12 mb-5 col-lg-6">
        <a href="https://www.youtube.com/watch?v=govmXpDGLpo&ab_channel=AutomationStepbyStep"
           data-fancybox data-type="iframe" data-preload="false" data-width="740" data-height="580">
          <div class="video_wrapper">
            <img src="{{asset('front')}}/assets/img/image%203.png" />
            <img class="play_icon" src="{{asset('front')}}/assets/img/videoicon.png">
            <p class="video_text">محاضرة قراه في تاريخنا الوطني</p>
            <div class="image_overlay"></div>
          </div>
        </a>
      </div>
      <div class="col-sm-12 mb-5 col-lg-6">
        <a href="https://www.youtube.com/watch?v=govmXpDGLpo&ab_channel=AutomationStepbyStep"
           data-fancybox data-type="iframe" data-preload="false" data-width="740" data-height="580">
          <div class="video_wrapper">
            <img src="{{asset('front')}}/assets/img/image%203.png" />
            <img class="play_icon" src="{{asset('front')}}/assets/img/videoicon.png">
            <p class="video_text">محاضرة قراه في تاريخنا الوطني</p>
            <div class="image_overlay"></div>
          </div>
        </a>
      </div>

    </div>
  </section>
</div>
</div>
@endsection
