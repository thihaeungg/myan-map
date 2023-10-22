<?php

namespace ThihaMorph\MyanMap\Eloquent;

use Illuminate\Database\Eloquent\Model;
use ThihaMorph\MyanMap\Trait\CommandMapTrait;

class Township extends Model
{
    use CommandMapTrait;

    protected $table = 'townships';

    protected $fillable = ['name'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
