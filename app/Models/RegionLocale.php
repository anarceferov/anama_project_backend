<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionLocale extends Model
{
    use HasFactory , UsesUuid;
    protected $keyType = 'string';
    protected $timestamp = false;
    protected $fillable = ['name', 'local'];
}
