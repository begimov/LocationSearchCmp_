<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    public function mapSearch(Request $request)
    {
        // TODO: Validation for lat and lng
        $lat = $request->lat;
        $lng = $request->lng;
        $items = Item::distance(10000,"{$lat},{$lng}")->get();
        // $items = Item::distance(10000,'45.05,7.6667')->get();

        return $items;

        // return view('map')->with(['items'=>$items]);
    }

    public function map()
    {
        return view('map');
    }
}
