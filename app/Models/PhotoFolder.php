<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoFolder extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = PhotoFolderLocale::class;
    protected $localableFields = ['name' , 'text'];
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
