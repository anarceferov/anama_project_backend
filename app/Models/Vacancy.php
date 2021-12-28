<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Vacancy extends Model
{
    use HasFactory, Localizable;
    protected $localeModel = VacancyLocale::class;
    protected $localableFields = ['title' , 'text'];
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid'];

    public function image()
    {
        return $this->belongsTo(File::class , 'image_uuid');
    }
}
