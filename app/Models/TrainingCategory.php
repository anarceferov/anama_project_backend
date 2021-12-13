<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = TrainingCategoryLocale::class;
    protected $localableFields = ['local' , 'name'];
    protected $keyType = 'integer';
}
