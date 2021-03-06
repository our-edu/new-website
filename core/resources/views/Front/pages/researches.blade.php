@extends('Front.layouts.default',['title'=>"الدرسات و الابحاث"])
@section('meta')
    @if(!empty($page))
        @include('Front.partials.meta',['row'=>$page,'route'=>route('researches')])
    @endif
@endsection
@section('content')
  <div class="container">
    <h1 class="pageDescription text-color-green">دراسات وبحوث</h1>
  </div>

  <div class="">
{{--    {{> articleSlider}}--}}
    @include('Front.partials.reserchSlider')

  </div>

  <div class="container">
          <div class="row mb-5" title="title" date="date" description="description">
              @foreach($articles->skip(3) as $article)
            <div class="col-lg-4">
{{--              {{> articlePreview}}--}}
              @include('Front.partials.reserchPreview')

            </div>
              @endforeach
          </div>
  </div>
@endsection
