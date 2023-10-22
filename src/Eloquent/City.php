<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name'];

    public function townships()
    {
        return $this->belongsToMany(Township::class, 'city_id', 'state_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
