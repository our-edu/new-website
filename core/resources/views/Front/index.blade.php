@extends('Front.layouts.front.front')
@section('header')
    @include('Front.layouts.front.includes.index-header')
@endsection

@section('content')
    @include('Front.layouts.index-sections.home')
    @include('Front.layouts.index-sections.books')
    @include('Front.layouts.index-sections.tweets')

@endsection

@section('footer')
    @include('Front.layouts.front.includes.footer')
@endsection