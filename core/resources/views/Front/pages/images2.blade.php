@extends('Front.layouts.default',['title'=>"contact"])
@section('content')
    <section class="images container">
        <div class="d-flex justify-content-between toggle_images-videos">
            <h1 class="pageDescription toggle_active">
                <a href="{{route('gallery')}}">الصور</a>
            </h1>
            <h1 class="pageDescription text-color-black">
                <a href="{{route('videos')}}">الفيديوهات</a>
            </h1>
        </div>

        <div class="grid-container">
            <!-- image wrapper -->
            @forelse($galleries as $gallery)
                @if(!empty($gallery->images))
                    <div class="image_wrapper" data-aos="fade">
                        <div class="main_image_wrapper">
                            <img data-fancybox="gallery1"
                                 src="{{env('APP_URL')."/".\Illuminate\Support\Str::}}"/>
                            <div class=" image_text">{{$gallery->title}}
                            </div>
                        </div>
                        <div class="parent">
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

                @endif
            @empty
            @endforelse

        </div>
    </section>
@endsection
