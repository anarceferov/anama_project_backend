<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessLocale extends Model
{
    use HasFactory , UsesUuid , SoftDeletes;
    protected $keyType = 'string';
    protected $fillable = ['process_id', 'text', 'local'];

}