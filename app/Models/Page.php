<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory , Localizable , SoftDeletes;
    protected $localeModel = PageLocale::class;
    protected $localableFields = ['name'];
    protected $keyType = 'integer';
    protected $fillable = ['name' , 'is_active'];
    public $timestamps = false;

    // public function pageLocales()
    // {
    //     return $this->hasMany(PageLocale::class , 'page_id');
    // }

}
