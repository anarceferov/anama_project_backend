<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Press extends Model
{
    use HasFactory , SoftDeletes , Localizable;
    protected $localeModel = PressLocale::class;
    protected $localableFields = ['title'];
    protected $keyType = 'integer';
    protected $fillable = ['date' , 'title' , 'file_uuid'];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_uuid');
    }

    // public function pressLocales()
    // {
    //     return $this->hasMany(PressLocale::class , 'press_id');
    // }
}
