<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
   public function index() { return response()->json(Hero::all(), 200); }

    public function store(Request $request) {
        $hero = Hero::create($request->all());
        return response()->json($hero, 201);
    }

    public function show($id) {
        $hero = Hero::with(['realm', 'artifacts'])->find($id);
        return $hero ? response()->json($hero, 200) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());
        return response()->json($hero, 200);
    }

    public function destroy($id) {
        Hero::destroy($id);
        return response()->json(null, 204);
    }

    public function assignArtifact(Request $request) {
    $hero = Hero::findOrFail($request->hero_id);
    $hero->artifacts()->attach($request->artifact_id);
    return response()->json(['message' => 'Artefacto asignado']);}

    public function alive() {
    // Esto busca en la tabla heroes donde la columna alive sea true
    $heroes = Hero::where('alive', true)->get();
    return response()->json($heroes, 200);
}
    public function removeArtifact(Request $request) 
{
    // Buscamos al héroe por el ID enviado
    $hero = Hero::findOrFail($request->hero_id);
    
    // El método detach elimina la relación en la tabla pivote
    $hero->artifacts()->detach($request->artifact_id);
    
    return response()->json(['message' => 'Artefacto retirado correctamente'], 200);
}
    public function artifacts($id) {
    // Buscamos el héroe primero
    $hero = Hero::find($id);
    
    if (!$hero) {
        return response()->json(['error' => 'Héroe no encontrado'], 404);
    }

    // Cargamos los artefactos usando la relación definida en el modelo
    return response()->json($hero->artifacts, 200);
    }
}