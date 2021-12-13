<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model
{
    use HasFactory, SoftDeletes, Localizable;
    protected $localeModel = ProjectCategoryLocale::class;
    protected $localableFields = ['title' , 'status' , 'city'];
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    public function project()
    {
        return $this->hasMany(Project::class , 'project_category_id')->with('image' , 'locales');
    }
}
