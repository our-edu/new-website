@extends('Front.layouts.default',['title'=>$article->title])
@section('meta')
  @include('Front.partials.meta',['row'=>$article,'route'=>route('article_details',$article->slug)])
@endsection
@section('content')
  <div class="container">
      <div class="row mb-5">
        <div class="col-lg-12 mb-2 text-center mb-lg-0 pb-3 p-0">
          <img src="{{$article->image}}" class="img-fluid" alt="Responsive image" />
        </div>
        <div class="detailsContainer">
          <span class="detailsDate">بتاريخ {{$article->created_at->format('d-m-Y')}}</span>
          <div class="detailTitles">
            <h2 class="detailsParagraphTitle">
              {{$article->title}}
            </h2>
            <div class="detailsViews"><span>{{$article->visits}} :عدد المشاهدات</span><i class="fa fa-eye mx-2"></i></div>
          </div>
          <div class="detailsParagraph text_black">

              {!! $article->article_content !!}

          </div>
        </div>
      </div>
  </div>
@endsection