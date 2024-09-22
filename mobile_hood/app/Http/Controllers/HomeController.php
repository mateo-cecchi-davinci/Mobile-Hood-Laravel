<?php

namespace App\Http\Controllers;

use App\Models\Buisness;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $buisnesses;
    protected $maps;

    public function __construct()
    {
        $this->buisnesses = Buisness::where('is_active', true)->with(['location'])->get();
        $this->maps = config('googlemaps.maps');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'buisnesses' => $this->buisnesses,
        ]);
    }

    public function buisness(Request $request)
    {
        $request->validate([
            'buisness' => 'required|integer',
        ]);

        $buisness = $this->buisnesses->firstWhere('id', $request->buisness);

        return view('buisness', [
            'buisness' => $buisness,
            'maps' => $this->maps
        ]);
    }
}
