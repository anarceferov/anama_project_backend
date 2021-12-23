<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use App\Models\File;

class PhotoFolder extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = PhotoFolderLocale::class;
    protected $localableFields = ['name' , 'text'];
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid'];

    public function photos()
    {
        return $this->hasMany(Photo::class)->with('images')->orderBy('created_at' , 'asc');
    }

    public function image()
    {
        return $this->belongsTo(File::class , 'image_uuid');
    }
}
