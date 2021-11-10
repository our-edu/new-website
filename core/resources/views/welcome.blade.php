@extends('layouts.front.front')
@section('title')
    Test
@endsection
@section('styles')
@include('layouts.front.partials.styles')
@endsection
@section('content')
    <nav>
        <img src="{{env('APP_URL')}}/assets/images/6Qo-yqjYIU0HgZXDcD8IniikzvfWjUZH.png"
             alt="ibn khaldon"
             width="150px"
        />
    </nav>
    <main>
        <div class="welcome text-center">
            <h1>Welcome to the Payment Portal</h1>
        </div>
        <div class="card">
            <form method="post" action="{{route('searchNationalId')}}">
                @csrf
                <div class="card-body">
                    <div class="card-item border-bottom-grey">
                        <div class="card-item_title">National ID</div>


                        <input type="text" name="national_id" placeholder="Enter Your National ID">
                    </div>
                    <div class="actions mb-2">
                        <button type="submit" class="button">
                            submit
                        </button>

                    </div>

            </form>
            @if($loginEnabled)
                <div class="actions mb-2"  >
                    <a href="#"> Login</a>

                </div>
            @endif
                @if($registerEnabled)
                    <div class="actions mb-2"  >
                        <a href="#"> Register</a>

                    </div>
                @endif

    </main>
@endsection