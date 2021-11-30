<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $path
 * @property string $extension
 * @property boolean $is_temp
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class File extends Model
{
    use UsesUuid;

    /**
     * @var array
     */
    protected $fillable = ['id', 'path', 'extension', 'is_temp', 'type', 'created_at', 'updated_at'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getPathAttribute($value): string
    {
        return config("app.FILE_PATH") . '/storage/' . $value;
    }
}