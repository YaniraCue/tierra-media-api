<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    protected $fillable = ['name', 'species', 'threat_level', 'region_id'];

    // Una criatura pertenece a una región
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
