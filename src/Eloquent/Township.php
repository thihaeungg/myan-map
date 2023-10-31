<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $table = 'townships';

    protected $fillable = ['name_mm', 'name_en', 'postal_code', 'active', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
