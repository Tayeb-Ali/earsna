<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __invoke()
    {
        $advertisements = Advertisement::where('status', 'active')->get();

        return response()->json(compact('advertisements'), 200);
    }
}
