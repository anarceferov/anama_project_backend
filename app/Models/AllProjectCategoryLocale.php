<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllProjectCategoryLocale extends Model
{
    use HasFactory, UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['all_project_category_id', 'name', 'local'];
}
