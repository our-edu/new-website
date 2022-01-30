<div class="card_wrapper">
  <div class="the_image d-flex align-items-center justify-content-center">
    <img class="w-100" src="{{env('APP_URL')."/storage/photos/".$book->book_img}}" />
  </div>
  <div class="the_details text-center">
    <h3 class="fw-bold text_head text_black text-center setTheight">{{$book->name}}
    </h3>
    <!-- <div class="my-1 text-center">
          <p class="gold">تاريخ النشر: 01-01-1999</p>
        </div> -->
    <p class="text-size-16 text_details text_clamb text-color-black text-center">
      {{$book->description}}
    </p>
    <div class="the_button text-center">
      <a href="{{env('APP_URL')."/storage/files/".$book->book_pdf}}" target="_blank">
        <button class="green">تحميل</button>
      </a>
    </div>
  </div>
</div>

