<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory, Localizable, FileRelation;
    protected $localeModel = PartnerLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['name', 'text'];
    protected $fillable = ['image_uuid'];

    protected $file = File::class;
    protected $key  = 'image_uuid';

    public function image()
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }
}
