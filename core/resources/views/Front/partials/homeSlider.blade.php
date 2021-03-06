<section class="slider_section">
  <div class="swiper-container two">
    <div class="swiper-wrapper">
      @foreach($articles as $article)
      <div class="swiper-slide">
        <div class="text">
          <p class="text-size-30 mb-3 fw-bold text_clamp_1"><a href="{{route('article_details',$article->slug)}}">{{$article->title}}</a></p>
          <p class="text-size-18 mb-3 text_clamp_2">
            {{\Illuminate\Support\Str::limit(strip_tags($article->description), 150)}}
          </p>
        </div>
        <div class="slider-image">
          <img src="{{env('APP_URL')."/storage/photos/".$article->post_img}}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="slider_footer">
    <div class="swiper-pagination"></div>
  </div>
</section>
