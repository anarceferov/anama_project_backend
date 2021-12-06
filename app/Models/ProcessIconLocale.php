<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessIconLocale extends Model
{
    use HasFactory , UsesUuid , SoftDeletes;
    protected $table = 'process_icon_locales';
    protected $keyType = 'string';
    protected $fillable = ['process_icons_id', 'text', 'local'];

}
