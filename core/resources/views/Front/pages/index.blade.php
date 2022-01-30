@extends('Front.layouts.home',['title'=>"الصفحة الرئيسية"])
@section('meta')
  @if(!empty($page))
    @include('Front.partials.meta',['row'=>$page,'route'=>route('home')])
  @endif
@endsection
@section('content')
  <div class="home">
    <!-- home absloute image -->
    <div class="row">
      <div class="col-lg-6 img_warpper p-0">
        <div class="">
          <img src="{{asset('front')}}/assets/img/MaskGroup.jpg">
        </div>
      </div>
    </div>
    <div class="important_">
      <div class="home_wrapper container-fluid">
        <!-- important articles -->
        <section class="">
          <div class="container" data-aos="fade">
            <div class="row position-relative">
            @foreach($importent_articles as $importent_article)

              <!-- section text -->
              <div class="col-md-12 col-lg-6">
                <h1 class="fw-bold text-color-gold">أهم الموضوعات</h1>
                <h2 class="fw-bold  text-white">
                  {{$importent_article->title}}
                </h2>
                <p class="text-color-3 text-size-18 text_details">
                  {{$importent_article->description}}
                </p>
                <div class="the_button">
                  <a href="{{route('articles')}}" class="text-size-18 main">المزيد...</a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </section>

        <!-- slider section -->
        <section class="section_with_slider position-relative" data-aos="fade">
          <div class="container">
            <h1 class="text-color-gold fw-bold">المقالات</h1>
          </div>
{{--          {{> homeSlider}}--}}
          @include('Front.partials.homeSlider')

        </section>
      </div>
    </div>

    <!-- books section -->
    <section class="books_section new_section">
      <div class="container">
        <h1 class="
                text-color-4
                text-center
                w-100
                fw-bold
                section_description
              ">
          الكتب
        </h1>
        <div class="row justify-content-between">
{{--          {{#each data.books}}--}}
          @foreach($books as $book)

          <div class="mb-80 col-xs-6 col-sm-6 col-md-4 col-lg-4" data-aos="fade">
{{--            {{> books }}--}}
            @include('Front.partials.books')

          </div>
{{--          {{/each}}--}}
          @endforeach

        </div>
      </div>
    </section>

    {{--<!-- tweet section -->
    <section class="tweet_section new_section">
      <div class="container">
        <h1 class="
                  text-center
                  w-100
                  fw-bold
                  section_description
                ">
          التغريدات
        </h1>
        <div class="row">
          <div class="text-center mb-3 col-12" data-aos="fade">
            <a class="twitter-timeline" href="https://twitter.com/ElemamAlii_?ref_src=twsrc%5Etfw">Tweets by
              ElemamAlii_</a>
          </div>
        </div>
      </div>
    </section>--}}
  </div>
@endsection
