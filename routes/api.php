<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RealmController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\ArtifactController;


// 1. RUTAS FIJAS (Sin {id}) 
Route::get('heroes/alive', [HeroController::class, 'alive']);
Route::get('artifacts/top', [ArtifactController::class, 'top']);
Route::get('creatures/dangerous', [CreatureController::class, 'dangerous']);

// 2. RUTAS DE RELACIÓN (Con {id})
Route::get('realms/{id}/heroes', [RealmController::class, 'heroes']);
Route::get('regions/{id}/creatures', [RegionController::class, 'creatures']);
Route::get('heroes/{id}/artifacts', [HeroController::class, 'artifacts']);
Route::get('artifacts/{id}/heroes', [ArtifactController::class, 'heroes']);

// 3. ASIGNACIONES (POST/DELETE)
Route::post('artifact-hero', [HeroController::class, 'assignArtifact']);
Route::delete('artifact-hero', [HeroController::class, 'removeArtifact']);

// 4. RECURSOS (apiResource) - SIEMPRE AL FINAL
Route::apiResource('regions', RegionController::class);
Route::apiResource('realms', RealmController::class);
Route::apiResource('heroes', HeroController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);