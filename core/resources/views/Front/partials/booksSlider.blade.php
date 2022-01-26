<div class="swiper booksSliderWrapper">
  <div class="swiper-wrapper">
    @foreach($books as $book)
    <div class="swiper-slide">
      @include('Front.partials.bookCardSlide')
    </div>
    @endforeach
  </div>
  <div class="swiper-pagination"></div>
</div>
