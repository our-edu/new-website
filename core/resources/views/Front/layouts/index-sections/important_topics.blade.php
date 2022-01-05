<div class="row website-container">
    @foreach($importent_articles as $importent_article)
    <div class="col-lg-6 col-sm-12 text-right section_wrapper">
        <div class="d-flex flex-column pt-5">
            <p class="big_font gold bold">أهم الموضوعات</p>
            <p class="p_title font_30 bold">
                {{$importent_article->title}}
            </p>
            <p class="text_details font_19 semi-bold">

                {{$importent_article->description}}

            </p>
            <div class="the_button gold">
                <button class="flat">المزيد ...</button>
            </div>
        </div>
    </div>
    <div
            class="
                col-lg-6 col-sm-12
                text-center
                d-none d-lg-block
                holder_
                mt-80
              "
    >
        <div class="section_image_wrapper">
            <img src="./events-activities/assets/img/Mask Group.jpg" />
        </div>
    </div>
    @endforeach
</div>