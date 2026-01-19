<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
   public function index() { return response()->json(Region::all(), 200); }

    public function store(Request $request) {
        $region = Region::create($request->all());
        return response()->json($region, 201);
    }

    public function show($id) {
        $region = Region::find($id);
        return $region ? response()->json($region, 200) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $region = Region::findOrFail($id);
        $region->update($request->all());
        return response()->json($region, 200);
    }

    public function destroy($id) {
        Region::destroy($id);
        return response()->json(null, 204);
    }
    public function creatures($id) {
    $region = Region::with('creatures')->findOrFail($id);
    return response()->json($region->creatures, 200);
    }
}
