<div class="container">
  <div class="swiper myArticleSwiper" style="border-radius: 5px; padding-bottom: 62px;">
    <div class="swiper-wrapper" style="display: flex; flex-direction: row;">
      @foreach($articles->take(3) as $article)

      <div class="swiper-slide">
        <div class="col-lg-6 col-12">
          <div class="text">
            <span class="articleSliderTitle">{{$article->title}}</span>
            <span class="articleSliderDate"> <span>اليوم</span> {{$article->created_at->toDateString()}} </span>
            <p class="articleSliderText">0
              {{strip_tags($article->description)}}

            </p>
            <div class="d-flex justify-content-between">
              <a class="article slider_article_button" href="{{route('article_details',$article->slug)}}">التفاصيل</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="slider-image">
            <img src="{{env('APP_URL')."/storage/photos/".$article->post_img}}">
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="sliderArrows">
      <div class="next mx-2">
        <i class="fas fa-long-arrow-alt-right mx-2"></i>
      </div>
      <div class="prev">
        <i class="fas fa-long-arrow-alt-left"></i>
      </div>
    </div>
</div>
