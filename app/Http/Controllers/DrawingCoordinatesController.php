<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\DrawingUpdated;

class DrawingCoordinatesController extends Controller
{
    public function store(Request $request)
    {
        $coordinates = $request->input('coordinates');
        $url = $request->input('url');
        $lineWidth = $request->input('lineWidth');
        $color = $request->input('color');

        broadcast(new DrawingUpdated($coordinates, $url,$lineWidth, $color))->toOthers();

        return response()->json(['message' => 'Drawing coordinates received and broadcasted successfully'], 200);
    }


}
