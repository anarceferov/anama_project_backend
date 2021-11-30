<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessesIcon extends Model
{
    use HasFactory , SoftDeletes;

    protected $table='processes_icons';

    protected $fillable = ['icon_uuid' , 'text' , 'text_en' , 'image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(File::class, 'icon_uuid');
    }
}
