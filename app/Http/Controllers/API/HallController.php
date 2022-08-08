<?php

namespace App\Http\Controllers\API;

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
        if (isset($request->city)) {
            $request->validate(['city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan', 'max:255']]);
            $halls = Hall::where('city', $request->city)->paginate(20);
        } else {
            $halls = Hall::paginate(20);
        }

        return response()->json($halls);
    }

    public function show($id)
    {
        $hall = Hall::find($id);
        if ($hall) {
            return response()->json(['data' => $hall, 'status' => true, 'message' => 'Hall found']);
        }
        return response()->json(['data' => null, 'status' => false, 'message' => 'Hall not found']);
    }
}
