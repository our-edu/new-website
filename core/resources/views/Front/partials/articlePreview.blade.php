<a href="{{route('article_details',$article->slug)}}">
    <div class="card border-0 pb-4">
        <div class="">
            <img class="card-img-top" src="{{env('APP_URL')."/storage/photos/".$article->post_img}}"  />
        </div>
        <div class="card-body" style="background: #F8F9F8;">
            <h5 class="card-title green text-right">{{\Illuminate\Support\Str::limit($article->title,50)}}</h5>
            <span class="articlesDate text-right">{{$article->created_at}}</span>
            <p class="card-txt green text_clamb">
                {{\Illuminate\Support\Str::limit(strip_tags($article->description , 150 ))}}
            </p>
            <div class="the_articlebutton green text-left" style="float: left; margin-left: 0.5rem; margin-top: 1rem;">
                <a class="article article_button" href="{{route('article_details',$article->slug)}}">التفاصيل</a>
            </div>
        </div>
    </div>
</a>