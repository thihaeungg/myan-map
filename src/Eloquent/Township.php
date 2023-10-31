<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;
use ThihaMorph\MyanMap\Eloquent\Rabbit;

class Township extends Model
{
    protected $table = 'townships';

    protected $appends = ['name_mm_zg'];

    public $timestamps = false;

    protected $fillable = ['name_mm', 'name_en', 'postal_code', 'active', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getNameMmZgAttribute()
    {
        return Rabbit::uni2zg($this->name_mm);
    }
}
