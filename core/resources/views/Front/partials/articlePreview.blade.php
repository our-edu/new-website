<a href="#">
    <div class="card border-0 pb-4">
        <div class="">
            <img class="card-img-top" src="{{asset('front')}}/assets/img/Taha.png"  />
        </div>
        <div class="card-body" style="background: #F8F9F8;">
            <h5 class="card-title green text-right">{{$article->title}}</h5>
            <span class="articlesDate text-right">{{$article->created_at}}</span>
            <p class="card-txt green text_clamb">
                {{strip_tags($article->description)}}
            </p>
            <div class="the_articlebutton green text-left" style="float: left; margin-left: 0.5rem; margin-top: 1rem;">
                <a class="article article_button" href="{{route('article_details',$article->uuid)}}">التفاصيل</a>
            </div>
        </div>
    </div>
</a>