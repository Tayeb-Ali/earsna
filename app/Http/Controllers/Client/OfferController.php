<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Offer;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    public function __construct()
    {
        if (!Session::get('hall')) {
            return redirect()->route('halls.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::latest()->paginate(30);

        return view('client.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'unique:offers,description'],
            'price' => ['required', 'numeric']
        ]);

        $offer = Offer::create([
            'description' => $request->description,
            'price' => $request->price,
            'hall_id' => Session::get('hall')->id
        ]);

        return redirect()->route('halls.offers.index', Session::get('hall')->id)
            ->withMessage(__('page.offers.flash.created', ['offer' => $offer->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall, Offer $offer)
    {
        return view('client.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall, Offer $offer)
    {
        $request->validate([
            'description' => ['required', 'string', 'unique:offers,description,' . $offer->description . ',description'],
            'price' => ['required', 'numeric']
        ]);

        $offer->update([
            'description' => $request->description,
            'price' => $request->price
        ]);

        return redirect()->route('halls.offers.index', Session::get('hall')->id)
            ->withMessage(__('page.offers.flash.updated', ['offer' => $offer->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall, Offer $offer)
    {
        $id = $offer->id;

        $offer->delete();

        return redirect()->route('halls.offers.index', Session::get('hall')->id)
            ->withMessage(__('page.offers.flash.deleted', ['offer' => $id]));
    }
}
