<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class HomeVideo extends Model
{
    use HasFactory;

    protected $fillable = ['video_uuid'];

    public function video()
    {
        return $this->belongsTo(File::class , 'video_uuid');
    }
}
