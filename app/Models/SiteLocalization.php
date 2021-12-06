<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteLocalization extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'local';
    protected $keyType = 'string';
    protected $casts = [
        'data' => "json"
    ];
    protected $fillable = ['data', 'local', 'is_active', 'created_at', 'updated_at'];
}
