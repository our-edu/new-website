@extends('Front.layouts.profile',['title'=>"profile"])
@section('content')
<div class="profile" data-aos="fade">
    <section class="image_with_text position-relative">
      <div clas="row">
        <!-- profile image -->
        <div class="p-0 col-md-12 col-lg-6 profile_image">
          <img src="{{asset('front')}}/assets/img/profile.png"/>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <!-- info -->
          <div class="col-md-12 col-lg-6 info_profile layout_wrapper">
            <div class="right_side">
              <div class="p-0">
                <h1 class="pageDescription">الملف الشخصي</h1>
                <div class="row">
                  <div class="col-12 about section_info">
                    <div class="row">
                      <!-- name -->
                      <div class="col-xs-12 col-md-6 about"> <p>الاسم والشهرة</p></div>
                      <div class="col-xs-12 col-md-6 details"> <p>د.عبد العزيز بن عبد الرحمن الثنيان</p></div>
                      <!-- born -->
                      <div class="col-xs-12 col-md-6 about"> <p>مكان و تاريخ الولادة</p></div>
                      <div class="col-xs-12 col-md-6 details"> <p>الرياض _ 1369 هـ</p></div>
                      <!-- Status -->
                      <div class="col-xs-12 col-md-6 about"> <p>الحالة الاجتماعية</p></div>
                      <div class="col-xs-12 col-md-6 details"> <p>متزوج ورب أسرة</p></div>
                      <!-- education -->
                      <div class="col-xs-12 col-md-6 about"> <p>المؤهل العلمي</p></div>
                      <div class="col-xs-12 col-md-6 details"> <p>دكتوراة في الادب العربي عام 1401 هـ جامعة الامام محمد بن سعود الاسلامية</p></div>
                      <!-- current job -->
                      <div class="col-xs-12 col-md-6 about"> <p>الاعمال الحالية</p></div>
                      <div class="col-xs-12 col-md-6 details"> <p>
                        الامين العام لمؤسسة الرياض الخيرية للعلوم
                        <br/>
                        نائب رئيس مجلس امناء جامعة الامير سلطان الاهلية
                        <br/>
                        رئيس مجلس أدارة شركه ابن خلدون التعليمية
                      </p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- last jobs -->
    <section class="profile_section with_bg">
      <div class="container">
        <div class="row ">
          <div class="col-12 about">
            <div class="row">
              <!-- name -->
              <div class="col-xs-12 col-md-3 about"> <p class="font_30">الاعمال السابقة</p></div>
              <div class="col-xs-12 col-md-9 pt-2 details white_text_profile">
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- section two -->
    <section class="profile_section"data-aos="fade" >
      <div class="container">
        <div class="row">
          <div class="col-12 about" data-aos="fade">
            <div class="row">
              <!-- name -->
              <div class="col-xs-12 col-md-3 about"> <p class="font_30">عضوية مجالس <br/>و لجان</p></div>
              <div class="col-xs-12 col-md-6 details">
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
                <p><span>1402 هـ 1412 هـ</span>  مدير عام التعليم بمنطقة الرياض</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Events -->
    <section class="profile_section with_bg" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-12 about">
            <div class="row">
              <!-- name -->
              <div class="col-xs-12 col-md-3 about"> <p class="font_30">المؤتمرات و الندوات</p></div>
              <div class="col-xs-12 col-md-9 details white_text_profile">
                <div class="pt-2 d-flex">
                  - <p class="">رئاسة وفد المملكة في بعض المؤتمرات رئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمرات </p>
                </div>
                <div class="pt-3 d-flex">
                  - <p class="">رئاسة وفد المملكة في بعض المؤتمرات رئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمرات </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- last section -->
    <section class="profile_section" data-aos="fade">
      <div class="container">
        <div class="row ">
          <div class="col-12 about">
            <div class="row">
              <!-- name -->
              <div class="col-xs-12 col-md-3 about text-xs-center"> <p class="font_30">المؤلفات </p></div>
              <div class="col-xs-12 pt-2 col-md-9 details">
                <ul class="p-0">
                  <li>
                    <p>رئاسة وفد المملكة في بعض المؤتمرات </p>
                  </li>
                  <li>
                    <p>رئاسة وفد المملكة في بعض المؤتمرات </p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
@endsection
