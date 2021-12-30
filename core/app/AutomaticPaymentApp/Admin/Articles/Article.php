<?php

namespace App\AutomaticPaymentApp\Admin\Articles;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{

    protected $table = 'articles';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'article_content',
        'post_img',
        'is_featured',
        'is_active',
    ];
    public function getData()
    {
        return $this;
    }
}