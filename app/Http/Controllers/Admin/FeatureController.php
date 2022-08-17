<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Feature;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Session;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $features = Feature::latest()->paginate(30);

        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'unique:features,description', 'max:225']
        ]);

        Feature::create($data);

        return redirect()
            ->route('features.index')
            ->withMessage(__('page.features.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feature $feature
     * @return Application|Factory|View
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Feature $feature
     * @return Response
     */
    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:255', 'unique:features,description,' . $request->description . ',description', 'max:225']
        ]);

        $feature->update($data);

        return redirect()
            ->route('features.index')
            ->withMessage(__('page.features.flash.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feature $feature
     * @return Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return back()->withMessage(__('page.features.flash.deleted'));
    }
}
