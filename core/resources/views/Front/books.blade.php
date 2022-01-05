@extends('Front.layouts.front.main',['title'=>"Books"])
@section('content')

    <div class="mb-80 section_wrapper books">
        <div class="website-container">
            <section>
                <p class="mb-5 big_font bold">الكتب</p>
                <div class="row">
                    @foreach($books as $book)

                    <div  class="mb-3 col-xs-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card_wrapper">
                            <div class="the_image d-flex align-items-center justify-content-center ">
                                <img class="w-100" src="./events-activities/assets/img/book.png"/>
                            </div>
                            <div class="the_details text-center">
                                <p class="text_head font_30 font-weight-bold">{{$book->name}}</p>
                                <div class="my-1 text-center">
                                    <p class="gold">تاريخ النشر: {{$book->publish_date}}</p>
                                </div>
                                <p class="text-center text-black-50">{{$book->description}}</p>
                                <div class="mt-3 text-center">
                                    <button class="download mt-3">تحميل</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- another books -->
            <section class="mt-80 onther_books">
                <p class="mb-80 mt-80 big_font bold">كتب انصح بقراءتها</p>
                <div>
                    <div class="row">
                        <div  class="mb-3 col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card_wrapper d-flex align-items-start justify-content-center flex-column">
                                <div class="the_image d-flex align-items-start justify-content-center ">
                                    <img class="w-100" src="assets/img/book.png"/>
                                </div>
                                <div class="the_details text-right">
                                    <p class="text_head font_30 font-weight-bold">أنسانية ملك</p>
                                    <div class="my-1 text-right">
                                        <p class="gold">تاريخ النشر: 01-01-1999</p>
                                    </div>
                                    <p class="text_details text-right text-black-50">يقدم هذا الكتاب سيرة الملك عبد العزيز بن عبد الرحمن أل السعود</p>
                                </div>
                            </div>
                        </div>
                        <div  class="mb-3 col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card_wrapper d-flex align-items-start justify-content-center flex-column">
                                <div class="the_image d-flex align-items-center justify-content-center ">
                                    <img class="w-100" src="assets/img/book.png"/>
                                </div>
                                <div class="the_details text-right">
                                    <p class="text_head font_30 font-weight-bold">أنسانية ملك</p>
                                    <div class="my-1 text-right">
                                        <p class="gold">تاريخ النشر: 01-01-1999</p>
                                    </div>
                                    <p class="text-right text-black-50">يقدم هذا الكتاب سيرة الملك عبد العزيز بن عبد الرحمن أل السعود</p>
                                </div>
                            </div>
                        </div>
                        <div  class="mb-3 col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card_wrapper d-flex align-items-start justify-content-center flex-column">
                                <div class="the_image d-flex align-items-center justify-content-center ">
                                    <img class="w-100" src="assets/img/book.png"/>
                                </div>
                                <div class="the_details text-right">
                                    <p class="text_head font_30 font-weight-bold">أنسانية ملك</p>
                                    <div class="my-1 text-right">
                                        <p class="gold">تاريخ النشر: 01-01-1999</p>
                                    </div>
                                    <p class="text-right text-black-50">يقدم هذا الكتاب سيرة الملك عبد العزيز بن عبد الرحمن أل السعود</p>
                                </div>
                            </div>
                        </div>
                        <div  class="mb-3 col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card_wrapper d-flex align-items-start justify-content-center flex-column">
                                <div class="the_image d-flex align-items-center justify-content-center ">
                                    <img class="w-100" src="assets/img/book.png"/>
                                </div>
                                <div class="the_details text-right">
                                    <p class="text_head font_30 font-weight-bold">أنسانية ملك</p>
                                    <div class="my-1 text-right">
                                        <p class="gold">تاريخ النشر: 01-01-1999</p>
                                    </div>
                                    <p class="text-right text-black-50">يقدم هذا الكتاب سيرة الملك عبد العزيز بن عبد الرحمن أل السعود</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>



@endsection