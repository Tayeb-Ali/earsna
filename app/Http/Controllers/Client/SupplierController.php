<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\NewSupplierRequest;
use App\Http\Requests\Client\UpdateSupplierRequest;
use App\Models\Admin\BusinessField;
use App\Models\Client\Supplier;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
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
        $suppliers = Supplier::latest()->paginate(30);

        return view('client.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business_fields = BusinessField::all();

        return view('client.suppliers.create', compact('business_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return redirect()->route('halls.suppliers.index', Session::get('hall')->id)
            ->withMessage(__('page.suppliers.flash.created', ['supplier' => $supplier->name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall, Supplier $supplier)
    {
        $business_fields = BusinessField::all();

        return view('client.suppliers.edit', compact('supplier', 'business_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Hall $hall, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()->route('halls.suppliers.index', Session::get('hall')->id)
            ->withMessage(__('page.suppliers.flash.updated', ['supplier' => $supplier->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall, Supplier $supplier)
    {
        $name = $supplier->name;

        $supplier->delete();

        return redirect()->route('halls.suppliers.index', Session::get('hall')->id)
            ->withMessage(__('page.suppliers.flash.deleted', ['supplier' => $name]));
    }
}
