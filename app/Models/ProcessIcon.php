<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcessIcon extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = ProcessIconLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text'];
    protected $table='processes_icons';
    protected $fillable = ['icon_uuid' , 'image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(File::class, 'icon_uuid');
    }

    // public function processIconLocales()
    // {
    //     return $this->hasMany(ProcessIconLocale::class , 'process_icon_id');
    // }
}
