<div class="card_wrapper_activities">
  <a href="">
    <div class="image_wrapper">
      <img src="https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0=">
    </div>
    <div class="card_infos">
      <div class="d-flex justify-content-between card_header">
        <p>اليوم {{$event->event_date}}</p>
        <p class="text-color-black text-size-14">من {{$event->start_time}}  الي {{$event->end_time}} <p>
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
