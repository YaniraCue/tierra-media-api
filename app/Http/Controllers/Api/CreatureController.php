<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Creature;

class CreatureController extends Controller
{
   public function index() { return response()->json(Creature::all(), 200); }

    public function store(Request $request) {
        $creature = Creature::create($request->all());
        return response()->json($creature, 201);
    }

    public function show($id) {
        // Incluye región
        $creature = Creature::with('region')->find($id);
        return $creature ? response()->json($creature, 200) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $creature = Creature::findOrFail($id);
        $creature->update($request->all());
        return response()->json($creature, 200);
    }

    public function destroy($id) {
        Creature::destroy($id);
        return response()->json(null, 204);
    }
    public function dangerous(Request $request) {
    $level = $request->query('level', 8); 
    $creatures = Creature::where('threat_level', '>=', $level)->get();
    return response()->json($creatures, 200);
    }
}
