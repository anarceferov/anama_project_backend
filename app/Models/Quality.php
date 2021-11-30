<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quality extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['image_uuid' , 'text_en' , 'text'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

}

