<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;
use ThihaMorph\MyanMap\Trait\CommandMapTrait;

class City extends Model
{
    use CommandMapTrait;

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
