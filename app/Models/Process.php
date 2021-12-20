<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Process extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = ProcessLocale::class;
    protected $localableFields = ['text'];
    protected $keyType = 'integer';
    protected $fillable = ['text' , 'image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    // public function processLocales()
    // {
    //     return $this->hasMany(ProcessLocale::class , 'process_id');
    // }
}
