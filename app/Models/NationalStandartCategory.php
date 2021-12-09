<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NationalStandartCategory extends Model
{
    use HasFactory, SoftDeletes, Localizable;

    protected $localeModel = NationalStandartCategoryLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['name'];
    protected $table = 'national_standart_categories';
    
    public function nationalStandarts()
    {
        return $this->hasMany(NationalStandart::class , 'national_standart_category_id')->with('locales');
    }

    public function nationalStandart()
    {
        return $this->hasMany(NationalStandart::class , 'national_standart_category_id')->with('locale');
    }


    public function getForeignKey()
    {
        return 'ns_category_id';
    }
}
