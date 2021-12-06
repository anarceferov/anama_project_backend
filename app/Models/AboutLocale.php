<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutLocale extends Model
{
    use HasFactory , UsesUuid , SoftDeletes;
    protected $keyType = 'string';
    protected $fillable = ['about_id', 'text', 'local'];

}