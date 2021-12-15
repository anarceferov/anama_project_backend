<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionData extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = RegionDataLocale::class;
    protected $localableFields = ['text' , 'name'];
    protected $keyType = 'integer';
    protected $fillable = ['year', 'month' , 'week' , 'tank' , 'clean_area' , 'unexplosive' , 'pedestrian' , 'region_id'];

    public function regions()
    {
        return $this->belongsTo(Region::class , 'region_id')->with('locales');
    }

    public function region()
    {
        return $this->belongsTo(Region::class , 'region_id')->with('locale');
    }
}
