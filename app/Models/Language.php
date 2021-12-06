<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory , UsesUuid;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name', 'key', 'is_active', 'created_at', 'updated_at'];

}
