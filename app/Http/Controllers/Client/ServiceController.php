<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Service;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
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
        $services = Service::latest()->paginate(30);

        return view('client.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.services.create');
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
            'description' => ['required', 'string', 'unique:services,description'],
            'price' => ['required', 'numeric'],
        ]);

        $service = Service::create([
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('halls.services.index', Session::get('hall')->id)
            ->withMessage(__('page.services.flash.created', ['service' => $service->name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall, Service $service)
    {
        return view('client.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall, Service $service)
    {
        $request->validate([
            'description' => ['required', 'string', 'unique:services,description,' . $service->description . ',description'],
            'price' => ['required', 'numeric'],
        ]);

        $service->update([
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('halls.services.index', Session::get('hall')->id)
            ->withMessage(__('page.services.flash.updated', ['service' => $service->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall, Service $service)
    {
        $name = $service->name;

        $service->delete();

        return redirect()->route('halls.services.index', Session::get('hall')->id)
            ->withMessage(__('page.services.flash.deleted', ['service' => $name]));
    }
}
