<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory , SoftDeletes , Localizable;

    protected $table = 'employees';
    protected $localeModel = EmployeeLocale::class;
    protected $keyType = 'integer';
    protected $localableFields = ['text' , 'position_name'];
    protected $fillable = ['text' ,'image_uuid', 'position_name' , 'order'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_uuid');
    }

    // public function employeeLocales()
    // {
    //     return $this->hasMany(EmployeeLocale::class , 'employee_id');
    // }
}
