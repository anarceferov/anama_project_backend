<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory , Localizable;
    protected $fillable = ['category_name' , 'count' , 'tel' , 'email' , 'sector'];
}
