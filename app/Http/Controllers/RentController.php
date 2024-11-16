<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Rules\Phone;

class RentController extends Controller
{
    // Display a listing of the buildings
    public function index()
    {
        return response()->json(Building::all(), 200);
    }

    // Store a newly created building in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'owner_name' => 'nullable|string',
            'owner_phone' => 'nullable|string',
            'pincode' => 'nullable|integer',
        ]);

        $building = Building::create($validatedData);

        return response()->json([
            'message' => 'Building created successfully!',
            'data' => $building,
        ], 201);
    }

    // Display the specified building
    public function show(Building $building)
    {
        // Load related rooms through floors
        $building->load('rooms');

        return response()->json([
            'id' => $building->id,
            'name' => $building->name,
            'owner_name' => $building->owner_name,
            'owner_phone' => $building->owner_phone,
            'pincode' => $building->pincode,
            'address' => $building->address,
            'rooms' => $building->rooms, // Include rooms data
        ], 200);

        // return response()->json($building, 200);
    }



    // Update the specified building in storage
    public function update(Request $request, Building $building)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => ['required', new Phone],
            'pincode' => 'required|integer'
        ]);

        $building->update($validatedData);
        return response()->json($building, 200);
    }

    // Remove the specified building from storage
    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
}
