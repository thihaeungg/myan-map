<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = ['name'];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'state_city', 'state_id', 'city_id');
    }
}
