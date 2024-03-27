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

        $itinerary->title = $request->title;
        $itinerary->category = $request->category;
        $itinerary->duration = $request->duration;
        $itinerary->image = $request->image;
        $itinerary->save();

        return response()->json($itinerary);
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
    public function destroy(Iteneraries $iteneraries)
    {
        //
    }
}
