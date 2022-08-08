<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Client\{NewCustomerRequest, UpdateCustomerRequest};
use App\Models\Client\Customer;
use App\Models\Hall;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $customers = Customer::whereHas('user', function ($query) {
            $query->where('hall_id', Session::get('hall')->id);
        })->latest()->paginate(30);

        return view('client.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('client.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewCustomerRequest $request
     * @return Response
     */
    public function store(NewCustomerRequest $request)
    {
        $user = $this->createCustomerUser($request);

        $customer = Customer::create(['user_id' => $user->id]);

        $user->update(['customer_id' => $customer->id]);

        return redirect()
            ->route('halls.customers.index', Session::get('hall')->id)
            ->withMessage(__('page.customers.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hall $hall
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Hall $hall, Customer $customer)
    {
        return view('client.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @param Hall $hall
     * @param Customer $customer
     * @return Response
     */
    public function update(UpdateCustomerRequest $request, Hall $hall, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('halls.customers.index', Session::get('hall')->id)
            ->withMessage(__('page.customers.flash.updated', ['customer' => $customer->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Hall $hall, Customer $customer)
    {
        $name = $customer->name;

        if (in_array($customer->booking->status, ['confirmed', 'temporary'])) {
            $customer->booking->delete();
        }

        $customer->delete();

        return back()->withMessage(__('page.customers.flash.deleted', ['customer' => $name]));
    }

    protected function createCustomerUser($request)
    {
        return User::create($request->validated() + ['hall_id' => Session::get('hall')->id]);
    }
}
