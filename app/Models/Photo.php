<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoFolder;
use App\Models\File;

class Photo extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->belongsTo(File::class , 'image_uuid');
    }


    public function folders()
    {
        return $this->belongsTo(PhotoFolder::class , 'photo_folder_id')->with('locales' , 'image');
    }


    public function folder()
    {
        return $this->belongsTo(PhotoFolder::class , 'photo_folder_id')->with('locale' , 'image');
    }

}
