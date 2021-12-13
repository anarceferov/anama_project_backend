<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{
    use HasFactory , SoftDeletes , Localizable;
    protected $localeModel = RuleLocale::class;
    protected $localableFields = ['text'];
    protected $keyType = 'integer';
}
