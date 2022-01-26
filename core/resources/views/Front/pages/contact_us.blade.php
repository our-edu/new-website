@extends('Front.layouts.default',['title'=>"contact"])
@section('content')

<div class="contact_us" data-aos="fade">
  <div class="row">
    <!-- contact us form section  -->
    <div class="col-12 contact_section" data-aos="fade">
      <section class="container">
        <h1 class="pageDescription text-center"> التواصل معنا</h1>
        <p class="text-center page_title">
          لديك استفسار معين يمكنك التواصل بالدكتور عبد العزيز عبر <br/>
          البريد الالكتروني او رقم الهاتف او ترك رسالة
        </p>
        <form type="POST" method="POST" title="حذف" action="{{route('ContactUs.store')}}" class="needs-validation" novalidate>
          @csrf
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
              <label for="email" class="form-label">البريد الالكتروني</label>
              <input placeholder="ضع البريد الالكتروني هنا" type="email" class="form-control" id="email" name="email" required>
              <div class="invalid-feedback">
                برجاء ادخال البريد الالكتروني
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
              <label for="firstName" class="form-label">الاسم الاول</label>
              <input placeholder="ضع الاسم الاول هنا" type="text" class="form-control" id="firstName" name="first_name"  required>
              <div class="invalid-feedback">
               برجاء ادخال الاسم الاول الخاص بك
              </div>
            </div>
            <div class="col-md-12 col-lg-4">
              <label for="secoundName" class="form-label">الاسم الثاني</label>
              <input placeholder="ضع الاسم الثاني هنا " type="text" class="form-control" id="secoundName" name="last_name" required>
              <div class="invalid-feedback">
                برجاء ادخال الاسم الثاني
              </div>
            </div>
            <div class="col-12">
              <label for="message" class="form-label">الرسالة</label>
              <textarea placeholder="أكتب رسالتك هنا " type="text" class="form-control" id="message" name="message" required></textarea>
              <div class="invalid-feedback">
               برجاء ترك رسالتك هنا
              </div>
            </div>
          </div>
          <div class="the_button">
            <button type="submit" class="btn form_submit">ارسل رسالتك</button>
          </div>
        </form>
      </section>
    </div>

    <!-- map section -->
    <div class="col-12 map_section" data-aos="fade">
      <section class="embed-responsive embed-responsive-21by9 contact_map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26432.42324808999!2d-118.34398767954286!3d34.09378509738966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf07045279bf%3A0xf67a9a6797bdfae4!2sHollywood%2C%20Los%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1576846473265!5m2!1sen!2sbd"
          width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
          class="embed-responsive-item"></iframe>
        <div id="over_map">
          <div class="item">
            <span>الرياض :  ص.ب :230310</span>
            <span>الرمز البريدي : 11321</span>
          </div>
          <div class="item">
            <span>البريد الالكروني :  </span>
            <span>net@ink.com</span>
          </div>
          <div class="item">
            <span> هاتف المكتب</span>
            <span>: 4801943 </span>
          </div>
          <div class="item">
            <span>فاكس المكتب</span>
            <span>: 480245  </span>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection