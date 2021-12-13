<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\File;
use App\Traits\Localizable;

class AllProjectCategory extends Model
{
    use HasFactory, Localizable;
    protected $localeModel = AllProjectCategoryLocale::class;
    protected $localableFields = ['name'];
    protected $keyType = 'integer';


    public function allProject()
    {
        return $this->hasMany(AllProject::class, 'all_project_category_id')->with('image', 'locales');
    }
}
