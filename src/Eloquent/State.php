<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = ['name_mm', 'name_en'];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'state_city', 'state_id', 'city_id');
    }

    public function self_administers()
    {
        return $this->belongsToMany(SelfAdminister::class, 'state_selfadminister', 'selfadminister_id');
    }
}
