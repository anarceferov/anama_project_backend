<?php 

namespace App\Traits;


trait FileRelation
{

    public function image()
    {
        return $this->belongsTo($this->file, $this->key);
    }

}