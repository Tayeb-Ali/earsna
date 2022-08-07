<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->isClient()) {
            $expenses = Expense::where('hall_id', Session::get('hall')->id)
                ->latest()->paginate(30);
        } else {
            $expenses = Expense::where('hall_id', null)
                ->latest()->paginate(30);
        }

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewExpenseRequest $request)
    {
        $data = $request->validated();

        if ($request->user()->isClient()) {
            $data['client_id'] = $request->user()->client_id;
        }

        Expense::create($data);

        return redirect()
            ->route('expenses.index')
            ->withMessage(__('page.expenses.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()
            ->route('expenses.index')
            ->withMessage(__('page.expenses.flash.updated', ['expense' => $expense->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense_id = $expense->id;

        $expense->delete();

        return redirect()->route('expenses.index')
            ->withMessage(__('page.expenses.flash.deleted', ['expense' => $expense_id]));
    }
}
