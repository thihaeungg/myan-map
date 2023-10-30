<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $table = 'townships';

    protected $fillable = ['name_mm', 'name_en'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
