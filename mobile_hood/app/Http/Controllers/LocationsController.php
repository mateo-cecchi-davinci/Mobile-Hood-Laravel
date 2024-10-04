<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $locations;
    protected $businesses;
    protected $maps;

    public function __construct()
    {
        $this->middleware('auth');
        $this->locations = Location::all();
        $this->businesses = Business::where('is_active', true)->get();
        $this->maps = config('googlemaps.maps');
    }

    public function index()
    {
        return view('locations.locations', ['locations' => $this->locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('locations.create', [
            'businesses' => $this->businesses,
            'maps' => $this->maps,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'business' => 'required|array|min:0|max:1',
        ]);

        $location = new Location();

        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->fk_locations_businesses = $request->business[0];

        $location->save();

        return redirect(route('locations.index'))->with('success', 'Ubicación agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('locations.show', [
            'location' => $location,
            'maps' => $this->maps
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit', [
            'location' => $location,
            'businesses' => $this->businesses,
            'maps' => $this->maps,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'business' => 'required|array|min:0|max:1',
        ]);

        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->fk_locations_businesses = $request->business[0];

        $location->save();

        return redirect(route('locations.index'))->with('success', 'Ubicación editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect(route('locations.index'))->with('success', 'Ubicación eliminada con éxito');
    }
}
