<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoFolder extends Model
{
    use HasFactory , SoftDeletes , Localizable;
    protected $localeModel = PhotoFolderLocale::class;
    protected $localableFields = ['name'];
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid' , 'order'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function image()
    {
        return $this->belongsTo(File::class , 'image_uuid');
    }
}
