<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = ['name_mm', 'name_en', 'flag', 'capital_id'];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'state_city', 'state_id', 'city_id');
    }

    public function self_administers()
    {
        return $this->hasMany(SelfAdminister::class, 'state_id', 'id');
    }

    public function capital()
    {
        return $this->belongsTo(City::class);
    }
}
