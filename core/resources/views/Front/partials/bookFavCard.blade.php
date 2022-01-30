<div class="card_wrapper">
  <div class="the_image d-flex">
    <img class="w-100" src="{{env('APP_URL')."/storage/photos/".$book->book_img}}" />
  </div>
  <div class="the_details">
    <h3 class="fw-bold text_head text_black" style="margin-bottom: 0!important">{{$book->name}}</h3>
    <div class="date">
      <span>تاريخ النشر: </span>
      <span>{{$book->publish_date}}</span>
    </div>
    <p class="text_clamb text-size-16 fw-bold text-color-black">
      {{strip_tags($book->description)}}
    </p>
  </div>
</div>

