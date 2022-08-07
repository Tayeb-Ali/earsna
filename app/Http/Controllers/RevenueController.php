<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRevenueRequest;
use App\Http\Requests\UpdateRevenueRequest;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->isClient()) {
            $revenues = Revenue::where('hall_id', Session::get('hall')->id)
                ->latest()->paginate(30);
        } else {
            $revenues = Revenue::where('hall_id', null)
                ->latest()->paginate(30);
        }

        return view('revenues.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('revenues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewRevenueRequest $request)
    {
        $data = $request->validated();

        if ($request->user()->isClient()) {
            $data['client_id'] = $request->user()->client_id;
        }

        Revenue::create($data);

        return redirect()
            ->route('revenues.index')
            ->withMessage(__('page.revenues.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Revenue $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Revenue $revenue)
    {
        return view('revenues.edit', compact('revenue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Revenue $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRevenueRequest $request, Revenue $revenue)
    {
        $revenue->update($request->validated());

        return redirect()
            ->route('revenues.index')
            ->withMessage(__('page.revenues.flash.updated', ['revenue' => $revenue->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Revenue $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        $revenue_id = $revenue->id;

        $revenue->delete();

        return redirect()->route('revenues.index')
            ->withMessage(__('page.revenues.flash.deleted', ['revenue' => $revenue_id]));
    }
}
