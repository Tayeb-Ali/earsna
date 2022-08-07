<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Expense;
use App\Models\Report;
use App\Models\Revenue;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->isClient()) {
            $reports = Report::where('hall_id', Session::get('hall')->id)
                ->latest()->paginate(30);
        } else {
            $reports = Report::where('hall_id', null)
                ->latest()->paginate(30);
        }

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewReportRequest $request)
    {
        $report = Report::create($this->getAttributes($request));

        return redirect()->route('reports.show', $report->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $data = [];

        $data['report'] = $report;

        if ($report->type === 'expenses' || $report->type === 'all') {
            $data['expenses'] = $this->getExpenses($report->from, $report->to);
        }

        if ($report->type === 'revenues' || $report->type === 'all') {
            $data['revenues'] = $this->getRevenues($report->from, $report->to);
        }

        return view('reports.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        $attributes = $this->getAttributes($request);

        $report->update($attributes);

        return redirect()->route('reports.show', $report->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report_id = $report->id;

        $report->delete();

        return redirect()
            ->route('reports.index')
            ->withMessage(__('page.reports.flash.deleted', ['report' => $report_id]));
    }

    protected function getAttributes($request)
    {
        $attributes = [];
        $total = 0;

        switch ($request->type) {
            case 'expenses':
                $data = $this->getExpenses($request->from, $request->to);

                break;
            case 'revenues':
                $data = $this->getRevenues($request->from, $request->to);

                break;
            default:
                $data = [];
                $data['expenses'] = $this->getExpenses($request->from, $request->to);
                $data['revenues'] = $this->getRevenues($request->from, $request->to);

                break;
        }

        foreach ($data as $item) {
            $total += $item->amount;
        }

        $average = count($data)
            ? $total / count($data)
            : 0;

        $attributes['from'] = $request->from;
        $attributes['to'] = $request->to;
        $attributes['type'] = $request->type;
        $attributes['average'] = $average;
        $attributes['total'] = $total;
        if ($request->user()->isClient() && session()->has('hall')) {
            $attributes['hall_id'] = Session::get('hall')->id;
        }

        return $attributes;
    }

    protected function getExpenses($from, $to)
    {
        return Expense::where('date', '>=', $from)
            ->where('date', '<=', $to)->get();
    }

    protected function getRevenues($from, $to)
    {
        return Revenue::where('date', '>=', $from)
            ->where('date', '<=', $to)->get()->toArray();
    }
}
