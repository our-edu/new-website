<div class="card_wrapper_activities">
  <a href="">
    <div class="image_wrapper">
      <img src="{{env('APP_URL')."/storage/photos/".$event->event_img}}">
    </div>
    <div class="card_infos">
      <div class="d-flex justify-content-between card_header">
        <p>اليوم {{$event->event_date}}</p>
        <p class="text-color-black text-size-14">من {{date('H:i', strtotime($event->start_time)) }} الي {{date('H:i', strtotime($event->end_time)) }}  <p>
      </div>
      <div class="card_body">
        <p class="head text-size-24 fw-bold text-color-green">{{$event->title}}</p>
        <p class="title text_clamb text-size-18 text-color-black">
          {{strip_tags($event->description)}}

        </p>
      </div>
    </div>
  </a>
</div>
