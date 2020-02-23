<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipPosition;

class ShipsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { }

    public function index(Request $request)
    {
       $data = [];

        if ($request->has('mmsi')) {
            $arrayOfMmsi = explode(",", $request->input('mmsi'));

            foreach ($arrayOfMmsi as $selectedOption) {              
               $query = ShipPosition::where('mmsi', intval($selectedOption))->get();
               foreach ($query as $v) {  
               array_push($data,$v);
               }
            }
     
        } else if ($request->has('minLat') && $request->has('minLat') && $request->has('minLon') && $request->has('maxLon')) {

            $minLat = floatval($request->input('minLat'));
            $maxLat = floatval($request->input('maxLat'));
            $minLon = floatval($request->input('minLon'));
            $maxLon = floatval($request->input('maxLon'));

            $data = ShipPosition::where(function ($query) use ($minLat, $maxLat, $minLon, $maxLon) {
                $query->whereBetween('lat', [$minLat, $maxLat])
                    ->orWhereBetween('lon', [$minLon, $maxLon]);
            })->get();

        } else if ($request->has('timestamp')) {
            $data = ShipPosition::where('timestamp', intval($request->input('timestamp')))->get();
        } else {
            $data = ShipPosition::get();
        }
        
        return $this->__(['data' => $data]);
    }
}
