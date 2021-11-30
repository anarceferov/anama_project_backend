<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'abouts';
    protected $fillable = ['date' , 'text' , 'image_uuid' , 'text_en'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

}
