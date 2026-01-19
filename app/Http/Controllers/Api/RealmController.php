<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Realm;

class RealmController extends Controller
{
    public function index() { return response()->json(Realm::all(), 200); }

    public function store(Request $request) {
        $realm = Realm::create($request->all());
        return response()->json($realm, 201);
    }

    public function show($id) {
        $realm = Realm::with(['region', 'heroes', 'artifacts'])->find($id);
        return $realm ? response()->json($realm, 200) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $realm = Realm::findOrFail($id);
        $realm->update($request->all());
        return response()->json($realm, 200);
    }

    public function destroy($id) {
        Realm::destroy($id);
        return response()->json(null, 204);
    }
    public function heroes($id) {
    $realm = Realm::with('heroes')->findOrFail($id);
    return response()->json($realm->heroes, 200);
    }
}
