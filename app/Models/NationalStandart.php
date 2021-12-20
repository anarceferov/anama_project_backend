<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalStandart extends Model
{
    use HasFactory, Localizable;
    protected $localeModel = NationalStandartLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text'];
    protected $fillable = ['text'];

    public function categories()
    {
        return $this->belongsTo(NationalStandartCategory::class , 'national_standart_category_id')->with('locales');
    }

    public function category()
    {
        return $this->belongsTo(NationalStandartCategory::class , 'national_standart_category_id')->with('locale');
    }
}
