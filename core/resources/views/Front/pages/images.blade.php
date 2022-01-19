@extends('Front.layouts.default',['title'=>"contact"])
@section('content')
<section class="images container">
    <div class="d-flex justify-content-between toggle_images-videos">
      <h1 class="pageDescription toggle_active">
        <a href="/gallery">الصور</a>
      </h1>
      <h1 class="pageDescription text-color-black">
        <a href="/videos">الفيديوهات</a>
      </h1>
    </div>

    <div class="grid-container">
        <!-- image wrapper -->
        <div class="image_wrapper" data-aos="fade">
          <div class="main_image_wrapper">
            <img data-fancybox="gallery1"
                 src="
                  https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0="
            />
            <div class="image_text">test</div>
          </div>
          <div class="parent" >
            <img data-fancybox="gallery1"
                 src="
                  https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0="
            />
            <img data-fancybox="gallery1"
                 src="
                  https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0="
            />
          </div>
        </div>

        <!-- image wrapper -->
        <div class="image_wrapper" data-aos="fade">
          <div class="main_image_wrapper">
            <img class="no_has_child" data-fancybox="gallery2"
                 src="
    https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR--XkZrj13TzniIZg8LGC8TQE58w66Y_uW9UEPixhG97EIUFXl1co_irXmV7tqaDwbZLw&usqp=CAU        "/>
            <div class="image_text">test</div>
            <div class="image_overlay"></div>
          </div>
          <div class="parent"></div>
        </div>

        <!-- image wrapper -->
        <div class="image_wrapper" data-aos="fade">
          <div class="main_image_wrapper">
            <img class="" data-fancybox="gallery3"
                 src="
                  https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0="
            />
            <div class="image_text">test</div>
            <div class="image_overlay"></div>
          </div>
          <div class="parent" >
            <img data-fancybox="gallery3"
                 src="
                  https://media.istockphoto.com/photos/panorama-of-cairo-picture-id1180786967?k=20&m=1180786967&s=612x612&w=0&h=-beRT5TLGlfeLmJP9m7Nv_8CKcM5kcrV-coR3fbvE_0="
            />
          </div>
        </div>

        <!-- image wrapper -->
        <div class="image_wrapper" data-aos="fade">
          <div class="main_image_wrapper">
            <img data-fancybox="gallery4"
                 src="
    https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROzkX9RSzji_TPZ2OFkU7MrC4oCLrF_aVNssMzSulrRLadTbY3QYjtzEiUqC4f72bg3Fs&usqp=CAU"        />
            <div class="image_text">test</div>
            <div class="image_overlay"></div>
          </div>
          <div class="parent" >
            <img data-fancybox="gallery4"
                 src="
    https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCZlf5lc5tX-0gY-y94pGS0mQdL-D0lCH2OQ&usqp=CAU"
            />
            <img data-fancybox="gallery4"
                 src="
    https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROzkX9RSzji_TPZ2OFkU7MrC4oCLrF_aVNssMzSulrRLadTbY3QYjtzEiUqC4f72bg3Fs&usqp=CAU
            "/>
          </div>
        </div>
    </div>
</section>
@endsection
