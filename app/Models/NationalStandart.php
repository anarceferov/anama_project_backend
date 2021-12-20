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

}
