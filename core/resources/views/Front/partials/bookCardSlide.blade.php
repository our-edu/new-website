<div class="card_wrapper">
  <div class="the_image d-flex align-items-center justify-content-center">
    <img class="w-100" src="{{asset('front')}}/assets/img/book.png" />
  </div>
  <div class="the_details text-center">
    <h2 class="fw-bold text_head text_black text-center">{{$book->name}}</h2>
    <div class="date">
      <span>تاريخ النشر: </span>
      <span>{{$book->publish_date}}</span>
    </div>
    <!-- <div class="my-1 text-center">
          <p class="gold">تاريخ النشر: 01-01-1999</p>
        </div> -->
    <p class="text-size-18 text-color-black text-center">
      {{strip_tags($book->description)}}

    </p>
    <div class="the_button text-center">
      <a href="#">
        <button class="green">تحميل</button>
      </a>
    </div>
  </div>
</div>

