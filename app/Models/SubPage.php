<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class SubPage extends Model
{
    use HasFactory , Localizable;
    protected $localeModel = SubPageLocale::class;
    protected $localableFields = ['name' , 'local'];
    protected $keyType = 'integer';
    protected $fillable = ['is_active' , 'key' , 'page_id'];
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class)->with('locales');
    }
}
