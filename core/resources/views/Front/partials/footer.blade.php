<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-xs-4 col-lg-6 colm_wrapper">
                <p class="mb-3 list_head font-weight-semibold">روابط سريعة</p>
                <div class="d-flex flex-column list">
                    <a href="{{route('home')}}">الرئيسية</a>
                    <a href="{{route('books')}}">الكتب</a>
                    <a href="{{route('articles')}}">اهم المقالات</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 colm_wrapper">
                <p class="mb-3 list_head font-weight-semibold">أتصل بنا</p>
                <div class="d-flex flex-column list">
                    <p>العنوان:  الرياض   ص.ب :230310</p>
                    <div class="d-flex emailOne    color: rgba(255, 255, 255, 0.7);
    margin: 5px 0;
    cursor: pointer;
    font-size: 14px;"><span>البريد الالكتروني: </span><a href="mailto:1@ikcedu.net">1@ikcedu.net</a></div>
                    <a href="tel: 009660114801943">هاتف المكتب: 009660114801943</a>
                    <p><a href="fax:+009660114802457"> فاكس المكتب: 009660114802457 </a></p>
                </div>
            </div>
            {{--<div class="col-lg-4 mb-xs-4 colm_wrapper">
              <p class="mb-3 list_head font-weight-semibold">
                للتواصل مع الدكتور/ عبد العزيز الثنيان <br />عبر مواقع التواصل
                الاجتماعي
              </p>
              <div class="list">
                <a href="">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="">
                  <i class="fab fa-linkedin"></i>
                </a>
                <a href="">
                  <i class="fab fa-dribbble"></i>
                </a>
              </div>
            </div>--}}
        </div>
    </div>
    <div class="col-lg-12 text-center pt-4">
        <p class="text-center text-white"><a href="https://our-education.net/" target="_blank"> تم تطويرها بشركه
                تعليمنا</a> @2022</p>
    </div>
</footer>
<!-- build:js -->
<script src="{{asset('front')}}/assets/vendor/js/jquery.js"></script>
<script src="{{asset('front')}}/assets/vendor/js/bootstrap.bundle.js"></script>
<!-- Animate on scroll JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- fancy apps -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>