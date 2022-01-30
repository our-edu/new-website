@extends('Front.layouts.default',['title'=>$event->title])
@section('meta')
  @include('Front.partials.meta',['row'=>$event,'route'=>route('event_details',$event->slug)])
@endsection
@section('content')
  <div class="container">
      <div class="row mb-5">
        <div class="col-lg-12 mb-2 text-center mb-lg-0 pb-3 p-0">
          <img src="{{$event->image}}" class="img-fluid" alt="Responsive image" />
        </div>
        <div class="detailsContainer">
          <span class="detailsDate">بتاريخ {{$event->event_date}} </span>
          <div class="detailTitles">
            <h2 class="detailsParagraphTitle">
              {{$event->title}}
            </h2>
            <div class="detailsViews"><span>{{$event->visits}} :عدد المشاهدات</span><i class="fa fa-eye mx-2"></i></div>
          </div>
          <div class="detailsParagraph text_black">
            <p>
              {{strip_tags($event->description)}}


            </p>
          </div>
        </div>
      </div>
  </div>
@endsection