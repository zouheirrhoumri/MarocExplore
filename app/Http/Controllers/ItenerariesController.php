<?php

namespace App\Http\Controllers;

use App\Models\Iteneraries;
use App\Http\Requests\StoreItenerariesRequest;
use App\Http\Requests\UpdateItenerariesRequest;
use App\Models\Destination;
use Illuminate\Http\Request;

class ItenerariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $itineraries = Iteneraries::all();

        return response()->json($itineraries);
    }
    public function store(Request $request)
    {

        $itinerary = new Iteneraries();
        $itinerary->title = $request->title;
        $itinerary->category = $request->category;
        $itinerary->duration = $request->duration;
        $itinerary->image = $request->image;
        $itinerary->user_id = auth()->id();
        $itinerary->save();

        return response()->json($itinerary, 201);
    }

    public function update(Request $request, Iteneraries $itinerary)
    {
        $this->authorize('update', $itinerary);

        $this->authorize('update', $itinerary);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'duration' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        $itinerary->update($validatedData);


        return response()->json($itinerary);
    }

    public function destroy(Iteneraries $itinerary)
    {
        $this->authorize('delete', $itinerary);

        $itinerary->delete();

        return response()->json(null, 204);
    }

    public function addDestination(Request $request, Iteneraries $itinerary)
    {
        $this->authorize('update', $itinerary);

        $destinations = $request->destinations;

        foreach ($destinations as $destinationData) {
            $destination = new Destination;
            $destination->name = $destinationData['name'];
            $destination->accommodation = $destinationData['accommodation'];
            $destination->activities = $destinationData['activities'];
            $destination->itinerary_id = $itinerary->id;
            $destination->save();
        }

        return response()->json($itinerary->destinations, 201);
    }

    public function search(Request $request)
    {
        $query = Iteneraries::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('duration')) {
            $query->where('duration', $request->duration);
        }

        $itineraries = $query->get();

        return response()->json($itineraries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Iteneraries $iteneraries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iteneraries $iteneraries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
}
