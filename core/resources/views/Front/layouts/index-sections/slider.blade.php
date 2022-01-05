<section class="slider_section">
    <div class="swiper-container two">
        <div class="swiper-wrapper">

           @foreach($articles as $article)
                <div class="swiper-slide">
                    <div class="text">
                        <p class="font_30 mb-3 bold">{{$article->title}}</p>
                        <p class="font_18 mb-3 semi-bold">
                           {{strip_tags($article->description)}}
                        </p>
                    </div>
                    <div class="slider-image">
                        <img src="https://oetest.tech/events-html/assets/img/image%203.png">
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="slider_footer">
        <div class="swiper-pagination"></div>
    </div>

</section>
