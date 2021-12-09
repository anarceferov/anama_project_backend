<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLocale extends Model
{
    use HasFactory , UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['video_id', 'title', 'local'];
}
