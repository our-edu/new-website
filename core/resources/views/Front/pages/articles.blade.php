@extends('Front.layouts.default',['title'=>"المقالات"])
@section('meta')
    @if(!empty($page))
        @include('Front.partials.meta',['row'=>$page,'route'=>route('articles')])
    @endif
@endsection
@section('content')
  <div class="container">
    <h1 class="pageDescription text-color-green">المقالات</h1>
  </div>

  <div class="">
{{--    {{> articleSlider}}--}}
    @include('Front.partials.articleSlider')

  </div>

  <div class="container">
          <div class="row mb-5" title="title" date="date" description="description">
              @foreach($articles->skip(3) as $article)
            <div class="col-lg-4">
{{--              {{> articlePreview}}--}}
              @include('Front.partials.articlePreview')

            </div>
              @endforeach
          </div>
  </div>
@endsection
