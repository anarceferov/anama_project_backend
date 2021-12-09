<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SubPage;

class Page extends Model
{
    use HasFactory, Localizable, SoftDeletes;
    protected $localeModel = PageLocale::class;
    protected $localableFields = ['name', 'local'];
    protected $keyType = 'integer';
    protected $fillable = ['is_active', 'key'];
    public $timestamps = false;

    public function subPage()
    {
        return $this->hasMany(SubPage::class , 'page_id')->where('is_active', 1)->with('locales');
    }
}
