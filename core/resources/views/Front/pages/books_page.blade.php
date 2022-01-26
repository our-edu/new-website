@extends('Front.layouts.default',['title'=>"Books"])
@section('content')
<div class="container books_page">
  <h1 class="pageDescription">الكتب</h1>
{{--  {{> booksSlider}}--}}
  @include('Front.partials.booksSlider')


  <section class="fav_books">
    <h2 class="section_title fw-bold">كتب انصح بقرائتها </h2>
    <div class="row">
{{--      {{#each data.booksFav}}--}}
      @foreach($recommended_books as $book)
      <div class="col-sm-6 col-md-3">
{{--        {{> bookFavCard }}--}}
        @include('Front.partials.bookFavCard')

      </div>
      @endforeach
    </div>
  </section>

</div>
@endsection

