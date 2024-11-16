<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Floor $floor)
    {
        return response()->json($floor->rooms, 200);
    }

    public function store(Request $request, Floor $floor)
    {
        $validatedData = $request->validate([
            
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'unit_type' => 'required|string|max:255',
            'sharing_type' =>'required|string|max:255',
        ]);

        $room = new Room();
        $room->floor_id = $floor->id;
        $room->capacity = $request->capacity;
        $room->price = $request->price;
        $room->availability = $request->availability;
        $room->unit_type = $request->unit_type;
        $room->sharing_type = $request->sharing_type;
        $room->save();

        return response()->json($room, 201);
    }

    public function show(Floor $floor, Room $room)
    {
        return response()->json($room, 200);
    }

    public function update(Request $request, Floor $floor, Room $room)
    {
        $validatedData = $request->validate([
           
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'unit_type' => 'required|string|max:255',
            'sharing_type' =>'required|string|max:255',
        ]);

        $room->update($validatedData);
        return response()->json($room, 200);
    }

    public function destroy(Floor $floor, Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }

    public function searchByType(Floor $floor, $type)
    {
        $rooms = $floor->rooms()->where('type', $type)->get();
        return response()->json($rooms, 200);
    }
}
