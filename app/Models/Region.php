<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = RegionLocale::class;
    protected $localableFields = ['name'];
    protected $keyType = 'integer';

    public function data()
    {
        return $this->hasOne(RegionData::class , 'region_id');
    }
}
