@extends('Front.layouts.default',['title'=>"activities"])
@section('content')
<div class="container">
    <h1 class="pageDescription text-color-green">الفاعليات و الانشطة</h1>
  <!-- main image page card -->
{{--  {{> activitiesMainCard textHead=data.activities.head textTitle=data.activities.title }}--}}
  @include('Front.partials.activitiesMainCard')


  <section class="activities_cards">
    <div class="row">
{{--      {{#each data.activitesimages}}--}}
      <div class="col-sm-6" data-aos="fade">
{{--        {{> activitiesCards}}--}}
        @include('Front.partials.activitiesCards')

      </div>
{{--      {{/each}}--}}
    </div>
  </section>
</div>
@endsection
