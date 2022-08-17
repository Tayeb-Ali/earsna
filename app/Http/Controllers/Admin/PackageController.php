<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewPackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Admin\Feature;
use App\Models\Admin\FeaturePackage;
use App\Models\Admin\Package;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.packages.index', ['packages' => Package::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.packages.create', ['features' => Feature::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(NewPackageRequest $request)
    {
        $input = $request->except('features');
        $package = Package::create($input);

        foreach ($request->features as $feature_id) {
            FeaturePackage::create([
                'feature_id' => $feature_id,
                'package_id' => $package->id
            ]);
        }

        return redirect()
            ->route('packages.index')
            ->withMessage(__('page.packages.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Package $package
     * @return Response
     */
    public function edit(Package $package)
    {
        $features = Feature::all();
        return view('admin.packages.edit', compact('package', 'features'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePackageRequest $request
     * @param Package $package
     * @return Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->except(['features']));

        // Delete old package feature
        $old_features = FeaturePackage::where('package_id', $package->id)->get();
        foreach ($old_features as $feature) {
            $feature->delete();
        }

        // insert new package features
        foreach ($request->features as $feature_id) {
            FeaturePackage::create([
                'feature_id' => $feature_id,
                'package_id' => $package->id,
                'hall_id' => Session::get('hall')->id
            ]);
        }

        return redirect()
            ->route('packages.index')
            ->withMessage(__('page.packages.flash.updated', ['package' => $package->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Package $package
     * @return Response
     */
    public function destroy(Package $package)
    {
        $name = $package->name;

        $package->delete();

        return back()->withMessage(__('page.packages.flash.deleted', ['package' => $name]));
    }
}
