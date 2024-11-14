<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index(Building $building)
    {
        return response()->json($building->floors);
    }

    public function store(Request $request, $building_id)
    {
        $request->validate([
            'floor_number' => 'required|integer',
            'name' => 'required|string|max:255',
            'total_rooms' => 'required|integer'
        ]);

        $building = Building::findOrFail($building_id);

        $floor = new Floor();
        $floor->building_id = $building->id;
        $floor->floor_number = $request->floor_number;
        $floor->name = $request->name;
        $floor->total_rooms = $request->total_rooms;
        $floor->save();

        return response()->json($floor, 201);
    }

    public function show(Building $building, Floor $floor)
    {
        return response()->json($floor);
    }

    public function update(Request $request, Building $building, Floor $floor)
    {
        $request->validate([
            'floor_number' => 'required|integer',
            'name' => 'required|string|max:255',
            'total_rooms' => 'required|integer'
        ]);

        $floor->update($request->all());
        return response()->json($floor);
    }

    public function destroy(Building $building, Floor $floor)
    {
        $floor->delete();
        return response()->json(null, 204);
    }
}
