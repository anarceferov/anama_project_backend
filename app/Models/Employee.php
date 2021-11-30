<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'employees';
    protected $fillable = ['text' , 'text_en' ,'image_uuid', 'position_name' , 'position_name_en' , 'order'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }
}
