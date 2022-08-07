<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate(['city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan', 'max:255']]);

        $halls = Hall::where('city', $request->city)->get();

        return response()->json(['halls' => $halls], 200);
    }

    public function show(Hall $hall)
    {
        return response()->json(['hall' => $hall]);
    }
}
