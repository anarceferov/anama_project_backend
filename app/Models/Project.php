<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory, Localizable;
    protected $localeModel = ProjectLocale::class;
    protected $localableFields = ['text'];
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }
}
