<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLocale extends Model
{
    use HasFactory, UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['name', 'local'];
}
