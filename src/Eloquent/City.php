<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name_mm', 'name_en', 'active', 'self_administer_id'];

    public function townships()
    {
        return $this->belongsToMany(Township::class,'city_township', 'city_id', 'township_id');
    }

    public function state()
    {
        return $this->belongsToMany(State::class, 'state_city', 'city_id', 'state_id');
    }

    public function self_administer()
    {
        return $this->belongsTo(SelfAdminister::class);
    }
}
