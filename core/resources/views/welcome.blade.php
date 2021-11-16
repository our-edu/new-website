@extends('layouts.front.front')
@section('title')
    {{__('payment.welcome')}}
@endsection
@section('styles')
    @include('layouts.front.partials.styles')
@endsection
@section('content')
    <nav>
        <img src="{{asset('/')}}/assets/images/6Qo-yqjYIU0HgZXDcD8IniikzvfWjUZH.png"
             alt="ibn khaldon"
             width="150px"
        />
    </nav>
    <main>
        <div class="welcome text-center">
            <h1>{{__('payment.welcome')}}</h1>
        </div>
        <div class="card">
            <form method="post" action="{{route('searchNationalId')}}">
                @csrf
                <div class="card-body">
                    <div class="card-item border-bottom-grey">
                        <label style="flex: 1;">
                            <div class="card-item_title">{{__('payment.national_id')}}</div>
                            <input type="text" class="form-control" name="national_id"
                                   placeholder="">
                            @error('national_id')
                            <small style="display: block; font-size: 0.8rem; color: red;">*National id is
                                required</small>
                            @enderror
                        </label>


                    </div>
                    <div class="actions mb-2">
                        <button type="submit" class="button">
                            {{__('payment.click_to_search')}}
                        </button>
                    </div>
                    <div class="actions mb-2">
                        @if(!empty($registerEnabled))
                            <button type="button"   class="button" onclick="window.open('{{env('REGISTER_URL')}}','_blank')">
                                {{__('payment.register')}}
                            </button>
                        @endif
                        @if(!empty($loginEnabled))
                            <button type="button" class="button" onclick="window.open('{{env('LOGIN_URL')}}','_blank')">
                                {{__('payment.login')}}
                            </button>
                        @endif
                    </div>

                </div>


            </form>


    </main>
@endsection