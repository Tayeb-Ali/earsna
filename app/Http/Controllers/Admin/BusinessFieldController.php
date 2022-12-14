<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BusinessField;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $businessFields = BusinessField::latest()->paginate(30);

        return view('admin.business-fields.index', compact('businessFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.business-fields.create');
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
            'name' => ['required', 'string', 'max:255'],
        ]);

        BusinessField::create($data);

        return redirect()
            ->route('business-fields.index')
            ->withMessage(__('page.businessFields.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BusinessField $businessField
     * @return Response
     */
    public function edit(BusinessField $businessField)
    {
        return view('admin.business-fields.edit', compact('businessField'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\BusinessField $businessField
     * @return Response
     */
    public function update(Request $request, BusinessField $businessField)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:advertisement,booking']
        ]);

        $businessField->update($data);

        return redirect()
            ->route('business-fields.index')
            ->withMessage(__('page.businessFields.flash.updated', ['field' => $businessField->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BusinessField $businessField
     * @return Response
     */
    public function destroy(BusinessField $businessField)
    {
        $name = $businessField->name;

        $businessField->delete();

        return redirect()
            ->route('business-fields.index')
            ->withMessage(__('page.businessFields.flash.deleted', ['field' => $name]));
    }
}
