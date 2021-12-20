<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imsma extends Model
{
    use HasFactory , Localizable , FileRelation;
    protected $localeModel = ImsmaLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text'];
    protected $fillable = ['text', 'image_uuid'];

    protected $file = File::class;
    protected $key  = 'image_uuid';



    // public function imsmaLocales()
    // {
    //     return $this->hasMany(ImsmaLocale::class, 'imsma_id');
    // }
}
