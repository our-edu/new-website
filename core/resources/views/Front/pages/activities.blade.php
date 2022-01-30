@extends('Front.layouts.default',['title'=>"الفاعليات و الانشطة"])
@section('meta')
  @if(!empty($page))
    @include('Front.partials.meta',['row'=>$page,'route'=>route('activities')])
  @endif
@endsection
@section('content')
<div class="container">
    <h1 class="pageDescription text-color-green">الفاعليات و الانشطة</h1>
  <!-- main image page card -->
{{--  {{> activitiesMainCard textHead=data.activities.head textTitle=data.activities.title }}--}}
  @include('Front.partials.activitiesMainCard')


  <section class="activities_cards">
    <div class="row">
      @foreach($events as $event)
      <div class="col-sm-6" data-aos="fade">
{{--        {{> activitiesCards}}--}}
        @include('Front.partials.activitiesCards')

      </div>
      @endforeach
    </div>
  </section>
</div>
@endsection
