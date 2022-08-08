<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ExpenseController extends Controller
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
     * @return Response
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
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(NewExpenseRequest $request)
    {
        $data = $request->validated();
//        return $request->user()->client_id;
        if (Session::get('hall')) {
            $data['hall_id'] = Session::get('hall')->id;
            Expense::create($data);

            return redirect()
                ->route('expenses.index')
                ->withMessage(__('page.expenses.flash.created'));
        } else {

            return redirect()->route('dashboard')
                ->withMessage(__('page.expenses.flash.failed'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Expense $expense
     * @return Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Expense $expense
     * @return Response
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
     * @param Expense $expense
     * @return Response
     */
    public function destroy(Expense $expense)
    {
        $expense_id = $expense->id;

        $expense->delete();

        return redirect()->route('expenses.index')
            ->withMessage(__('page.expenses.flash.deleted', ['expense' => $expense_id]));
    }
}
