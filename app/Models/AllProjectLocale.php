<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllProjectLocale extends Model
{
    use HasFactory, UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['all_project_id', 'text', 'local'];
}
