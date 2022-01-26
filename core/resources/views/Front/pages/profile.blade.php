@extends('Front.layouts.profile',['title'=>"profile"])
@section('content')
<div class="profile" data-aos="fade">
  {!! $profile->body !!}

</div>
@endsection
