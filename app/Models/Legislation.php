<?php

namespace App\Models;

use App\Traits\FileRelation;
use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislation extends Model
{
    use HasFactory , Localizable, FileRelation;
    protected $localeModel = LegislationLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text'];
    protected $fillable = ['created_at' , 'updated_at'];
}
