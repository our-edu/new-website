<footer class="">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 mb-xs-4 col-lg-6 colm_wrapper">
        <p class="mb-3 list_head font-weight-semibold">روابط سريعة</p>
        <div class="d-flex flex-column list">
          <a href="{{route('home')}}">الرئيسية</a>
          <a href="{{route('books')}}">المدونه</a>
          <a href="{{route('articles')}}">اهم المقالات</a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6 colm_wrapper">
        <p class="mb-3 list_head font-weight-semibold">أتصل بنا</p>
        <div class="d-flex flex-column list">
          <p>العنوان: 4028 الامير مشعل ابن عبد العزيز - الرياض</p>
          <a href="mailto: 1@ikiu.net">البريد الالكتروني: 1@ikiu.net</a>
          <a href="tel: 55484">هاتف المكتب: 554848</a>
          <p>فاكس المكتب: 4054548</p>
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
    <p class="text-center text-white">جميع الحقوق محفوظه 2021@</p>
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