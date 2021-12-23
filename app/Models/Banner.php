<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BannerLocale;

class Banner extends Model
{
    use HasFactory, Localizable, FileRelation;
    protected $localeModel = BannerLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text'];
    protected $fillable = ['image_uuid' , 'is_active'];

    protected $file = File::class;
    protected $key  = 'image_uuid';
}
