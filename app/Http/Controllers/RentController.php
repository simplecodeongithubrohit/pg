<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class RentController extends Controller
{
    // Display a listing of the buildings
    public function index()
    {
        return Building::all();
    }

    

    // Store a newly created building in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        $building = Building::create($request->all());
        return response()->json($building, 201);
    }

    // Display the specified building
    public function show(Building $building)
    {
        return response()->json($building);
    }


    // Update the specified building in storage
    public function update(Request $request, Building $building)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        $building->update($request->all());
        return response()->json($building);
    }

    // Remove the specified building from storage
    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
}
