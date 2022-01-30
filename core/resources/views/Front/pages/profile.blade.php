@extends('Front.layouts.profile',['title'=>"profile"])
@section('meta')
  @include('Front.partials.meta',['row'=>$profile,'route'=>route('profile')])
@endsection
@section('content')
<div class="profile" data-aos="fade">
  {!! $profile->body !!}

</div>
@endsection
