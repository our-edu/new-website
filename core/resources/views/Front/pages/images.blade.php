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
                            <img data-fancybox="gallery{{$gallery->uuid}}"
                                 src="{{env('APP_URL')."/".$gallery->images[0]}}"/>
                            <div class=" image_text">{{$gallery->title}}
                            </div>
                        </div>
                        <div class="parent">
                            @foreach($gallery->images as $image)
                                <img data-fancybox="gallery{{$gallery->uuid}}"
                                     src="{{env('APP_URL')."/".$image}}"

                                />
                            @endforeach

                        </div>
                    </div>

                @endif
            @empty
            @endforelse

        </div>
    </section>
@endsection
