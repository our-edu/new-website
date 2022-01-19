<div class="swiper booksSliderWrapper">
  <div class="swiper-wrapper">
{{--    {{#each data.books}}--}}
    <div class="swiper-slide">
      @include('Front.partials.bookCardSlide')
    </div>
{{--    {{/each}}--}}
  </div>
  <div class="swiper-pagination"></div>
</div>
