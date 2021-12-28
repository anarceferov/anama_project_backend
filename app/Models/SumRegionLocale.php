<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumRegionLocale extends Model
{
    use HasFactory, UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['text', 'local', 'sum_region_id'];
}
