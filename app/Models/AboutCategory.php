<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\About;

class AboutCategory extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    protected $table = 'about_categories';

    public function abouts()
    {
        return $this->hasMany(About::class, 'about_category_id')->with('locales' , 'image');
    }

    public function deletes()
    {
        return $this->hasMany(AboutLocale::class , 'about_id');
    }
}
