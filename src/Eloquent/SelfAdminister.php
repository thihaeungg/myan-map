<?php

namespace ThihaMorph\MyanMap\Eloquent;

use ThihaMorph\MyanMap\Eloquent\City;
use ThihaMorph\MyanMap\Eloquent\State;
use Illuminate\Database\Eloquent\Model;

class SelfAdminister extends Model
{
    protected $table = 'selfadministers';

    protected $fillable = ['name_mm', 'name_en', 'flag', 'capital_id'];

    public function cities()
    {
        return $this->hasMany(City::class, 'self_administer_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function capital()
    {
        return $this->belongsTo(City::class);
    }
}
