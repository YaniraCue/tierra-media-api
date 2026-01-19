<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    protected $fillable = ['name', 'type', 'origin_realm_id', 'power_level', 'description'];

    // Un artefacto tiene un reino de origen
    public function originRealm()
    {
        return $this->belongsTo(Realm::class, 'origin_realm_id');
    }

    // Un artefacto puede pertenecer a muchos héroes
    public function heroes()
    {
        return $this->belongsToMany(Hero::class, 'artifact_hero', 'artifact_id', 'hero_id');
    }
}
