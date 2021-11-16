@extends('layouts.front.front')
@section('title')
    Payment Form
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

        <div class="card">
            <form method="post" action="{{$url}}">
                @csrf
                <div class="card-body">
                    <div class="card-item border-bottom-grey">
                        <div class="card-item_content">{{$parentDue->parent_name}}</div>

                        <div class="card-item_title">{{__('payment.parent_name',[],$language)}}</div>
                    </div>
                    <div class="card-item border-bottom-grey">
                        <div class="card-item_content">{{$parentDue->national_id}}</div>

                        <div class="card-item_title">{{__('payment.national_id',[],$language)}}</div>
                    </div>


                    <div class="card-item border-bottom-grey">
                        <div class="card-item_content">{{$parentDue->email}}</div>

                        <div class="card-item_title">{{__('payment.email',[],$language)}}</div>
                    </div>
                    <div class="card-item border-bottom-grey">
                        <div class="card-item_content">
                            <input type="text" name="amount" value="" class="form-control">
                        </div>

                        <div class="card-item_title">{{__('payment.amountToPay',[],$language)}}</div>
                    </div>

                    <div class="total">
                        <div class="header">
                            <div class="card-item_content" style="color: #32ba7c">{{$parentDue->balance}}</div>
                            <div class="card-item_title">{{__('payment.required_balance',[],$language)}}</div>
                        </div>


                    </div>
                    <input type="hidden" name="parent_due_uuid" value="{{$parentDue->uuid}}">

                    <input type="hidden" name="merchant_reference" value="{{$merchant_reference}}">
                    <div class="actions mb-2">
                        <button type="submit" class="button">
                            {{__('payment.click_to_complete',[],$language)}}
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
                    <div class="text-center">
                        <img src="{{env('APP_URL')}}/assets/images/mada.png" class="mx-2"
                             alt="mada"
                             height="30px"/>
                        <img src="{{env('APP_URL')}}/assets/images/visa.png" class="mx-2"
                             alt="visa"
                             height="30px"/>
                        <img src="{{env('APP_URL')}}/assets/images/mastercard.png" class="mx-2"
                             alt="mastercard"
                             height="30px"/>
                    </div>

                </div>
            </form>

        </div>
    </main>
@endsection