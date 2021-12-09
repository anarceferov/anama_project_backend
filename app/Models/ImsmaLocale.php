<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImsmaLocale extends Model
{
    use HasFactory , UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['imsma_id', 'text', 'local'];

}
