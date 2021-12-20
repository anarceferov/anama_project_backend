<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = RuleLocale::class;
    protected $localableFields = ['text'];
    protected $keyType = 'integer';
}
