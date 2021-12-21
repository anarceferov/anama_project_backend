<?php

namespace App\Models;

use App\Traits\FileRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySite extends Model
{
    use HasFactory , FileRelation;
    protected $keyType = 'integer';
    protected $fillable = ['image_uuid' , 'url'];

    protected $file = File::class;
    protected $key  = 'image_uuid';
}
