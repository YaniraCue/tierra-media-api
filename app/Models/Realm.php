<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
    protected $fillable = ['name', 'ruler', 'alignment', 'region_id'];

    // Un reino pertenece a una región
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Un reino tiene muchos héroes
    public function heroes()
    {
        return $this->hasMany(Hero::class); 
    }

    // Un reino es el origen de muchos artefactos
    public function artifacts()
    {
        return $this->hasMany(Artifact::class, 'origin_realm_id');
    }
}
