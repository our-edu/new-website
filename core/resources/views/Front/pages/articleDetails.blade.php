@extends('Front.layouts.default',['title'=>"المقالات"])
@section('content')
  <div class="container">
      <div class="row mb-5">
        <div class="col-lg-12 mb-2 text-center mb-lg-0 pb-3 p-0">
          <img src="{{asset('front')}}/assets/img/Motakaed.png" class="img-fluid" alt="Responsive image" />
        </div>
        <div class="detailsContainer">
          <span class="detailsDate">بتاريخ {{$article->created_at}}</span>
          <div class="detailTitles">
            <h2 class="detailsParagraphTitle">
              {{$article->title}}
            </h2>
            <div class="detailsViews"><span>4239 :عدد المشاهدات</span><i class="fa fa-eye mx-2"></i></div>
          </div>
          <div class="detailsParagraph text_black">
            <p>
              {{strip_tags($article->article_content)}}


            </p>
          </div>
        </div>
      </div>
  </div>
@endsection