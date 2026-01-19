<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artifact;

class ArtifactController extends Controller
{
    public function index() { return response()->json(Artifact::all(), 200); }

    public function store(Request $request) {
        // Crea el artefacto con los datos básicos
        $artifact = Artifact::create($request->all());
        
        // Si en el JSON de Postman envías "hero_id", se asocia automáticamente
        if ($request->has('hero_id')) {
            $artifact->heroes()->attach($request->hero_id);
        }
        
        return response()->json($artifact, 201);
    }

    public function show($id) {
        // Incluye reino de origen y héroes que lo poseen
        $artifact = Artifact::with(['originRealm', 'heroes'])->find($id);
        return $artifact ? response()->json($artifact, 200) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $artifact = Artifact::findOrFail($id);
        $artifact->update($request->all());
        return response()->json($artifact, 200);
    }

    public function destroy($id) {
        Artifact::destroy($id);
        return response()->json(null, 204);
    }
    public function top() {
    return response()->json(Artifact::where('power_level', '>', 90)->get(), 200);
    }
    public function heroes($id)
{
    $artifact = Artifact::find($id);

    if (!$artifact) {
        return response()->json(['error' => 'Artefacto no encontrado'], 404);
    }
    return response()->json($artifact->heroes, 200);
}
}
