<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumRegion extends Model
{
    use HasFactory, Localizable;
    protected $localeModel = SumRegionLocale::class;
    protected $localableFields = ['text'];
    protected $keyType = 'integer';
    protected $fillable = ['year', 'month', 'week', 'tank', 'clean_area', 'unexplosive', 'pedestrian'];
}
