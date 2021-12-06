<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chronology extends Model
{
    use HasFactory , SoftDeletes , Localizable;
    protected $table = 'chronologies';
    protected $keyType = 'integer';
    protected $localeModel = ChronologyLocale::class;
    protected $localableFields = ['text'];
    protected $fillable = ['date' , 'image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    // public function chronologyLocales()
    // {
    //     return $this->hasMany(ChronologyLocale::class , 'chronology_id');
    // }
}
