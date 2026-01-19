<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    // Una región tiene muchos reinos
    public function realms()
    {
        return $this->hasMany(Realm::class);
    }

    // Una región tiene muchas criaturas
    public function creatures()
    {
        return $this->hasMany(Creature::class);
    }
}
