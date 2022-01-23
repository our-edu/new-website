<section class="page_main_card">
  @foreach($last_event as $event)

  <a href="">
    <div class="image_wrapper">
      <img src={{asset('front')}}/assets/img/image14.png>
    </div>
    <div class="text_overlay">
      <p class="head text-size-24 fw-bold">{{$event->title}} </p>
      <p class="title text-size-18 text-color-white">
        {{strip_tags($event->description)}}
      </p>
    </div>
  </a>
  @endforeach
</section>
