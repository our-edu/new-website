<section class="slider_section">
  <div class="swiper-container two">
    <div class="swiper-wrapper">
      @foreach($articles as $article)
      <div class="swiper-slide">
        <div class="text">
          <p class="text-size-30 mb-3 fw-bold">{{$article->title}}</p>
          <p class="text-size-18 mb-3">
            {{strip_tags($article->description)}}
          </p>
        </div>
        <div class="slider-image">
          <img src="{{asset('front')}}/assets/img/Taha.png">
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="slider_footer">
    <div class="swiper-pagination"></div>
  </div>
</section>
