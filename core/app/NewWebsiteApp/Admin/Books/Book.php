<?php

namespace App\NewWebsiteApp\Admin\Books;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends BaseModel
{

    protected $table = 'books';
    public $timestamps = true;

    protected $fillable =[
        'name',
        'description',
        'book_img',
        'is_featured',
        'is_recommended',
        'publish_date',
        'author',
    ];
    public function getData()
    {
        return $this;
    }
}