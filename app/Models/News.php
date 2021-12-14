<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NewsCategory;

class News extends Model
{
    use HasFactory, SoftDeletes, Localizable , FileRelation;

    protected $localeModel = NewsLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text' , 'title'];
    protected $fillable = ['text', 'news_category_id' , 'is_active'];

    protected $file = File::class;
    protected $key  = 'image_uuid';

    public function category()
    {
        return $this->belongsTo(NewsCategory::class , 'news_category_id' , 'id')->with('locale');
    }

}
