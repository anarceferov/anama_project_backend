<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imsma extends Model
{
    use HasFactory, SoftDeletes, Localizable , FileRelation;
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
