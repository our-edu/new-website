@extends('Front.layouts.default',['title'=>"فيديوهات"])
@section('meta')
  @if(!empty($page))
    @include('Front.partials.meta',['row'=>$page,'route'=>route('videos')])
  @endif
@endsection
@section('content')
<div class="videos container">
  <div class="d-flex justify-content-between toggle_images-videos">
    <h1 class="pageDescription">
      <a href="{{route('gallery')}}">الصور</a>
    </h1>
    </h1>
    <h1 class="toggle_active pageDescription">
      <a href="{{route('videos')}}">الفيديوهات</a>
    </h1>
  </div>


{{--  {{> videosMainCard textHead=data.videos.head textTitle=data.videos.title }}--}}
  @include('Front.partials.videosMainCard')


  <section class="more_videos">
    <div class="row">
      @foreach($videos->skip(1) as $video)
      <div class="col-sm-12 mb-5 col-lg-6">
        <a href="{{$video->video_url}}"
          data-fancybox data-type="iframe" data-preload="false" data-width="740" data-height="580">
          <div class="video_wrapper">
            <img src="{{env('APP_URL')."/storage/photos/".$video->cover_image}}" />
            <img class="play_icon" src="{{asset('front')}}/assets/img/videoicon.png">
            <p class="video_text">{{$video->title}}</p>
            <div class="image_overlay"></div>
          </div>
        </a>
      </div>
      @endforeach

    </div>
  </section>
</div>
@endsection
