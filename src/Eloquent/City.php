<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;
use ThihaMorph\MyanMap\Eloquent\Rabbit;

class City extends Model
{
    protected $table = 'cities';

    protected $appends = ['name_mm_zg'];

    public $timestamps = false;

    protected $fillable = ['name_mm', 'name_en', 'active', 'self_administer_id'];

    public function townships()
    {
        return $this->hasMany(Township::class, 'city_id', 'id');
    }

    public function state()
    {
        return $this->belongsToMany(State::class, 'state_city', 'city_id', 'state_id');
    }

    public function self_administer()
    {
        return $this->belongsTo(SelfAdminister::class);
    }

    public function getNameMmZgAttribute()
    {
        return Rabbit::uni2zg($this->name_mm);
    }
}
