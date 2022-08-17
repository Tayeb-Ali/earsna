<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\BusinessField;
use App\Models\Admin\Feature;
use App\Models\Admin\Package;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $package = Package::latest()->with('features', 'subscriptions')->get();
        $business_field = BusinessField::latest()->get();
        $with = $request->with ? $request->with : [];
        if (isset($request->city)) {
            $request->validate(['city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan', 'max:255']]);
            $halls = Hall::where('city', $request->city)->with($with)->paginate(20);
        } else {
            $halls = Hall::with($with)->paginate(20);
        }
        $halls->add($package);

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
