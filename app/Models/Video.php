<?php

namespace App\Models;

use App\Traits\Localizable;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory , SoftDeletes , Localizable;
    protected $localeModel = VideoLocale::class;
    protected $localableFields = ['title'];
    protected $keyType = 'integer';
    protected $fillable = ['url'];
}
