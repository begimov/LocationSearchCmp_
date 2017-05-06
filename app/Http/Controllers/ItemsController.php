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
        // \DB::enableQueryLog();
        $items = Item::distance(10000,"{$lat},{$lng}")->get();
        // dd(\DB::getQueryLog());
        return $items->toArray();
    }

    public function map()
    {
        return view('map');
    }
}
