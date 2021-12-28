<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyLocale extends Model
{
    use HasFactory, UsesUuid;
    protected $keyType = 'string';
    protected $fillable = ['title', 'local', 'vacancy_id', 'text'];
}
