<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Press extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['date' , 'title' , 'title_en' , 'file_uuid'];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_uuid');
    }
}
