<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\NewSubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\Package;
use App\Models\Admin\Subscription;
use App\Models\Hall;
use App\Notifications\ClientSubscribedNotification;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::latest()->paginate(30);

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $packages = Package::all();

        return view('admin.subscriptions.create', compact('clients', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewSubscriptionRequest $request)
    {
        $subscription = Subscription::create([
            'client_id' => $request->client_id,
            'package_id' => $request->package_id
        ]);

        $this->createClientHalls($request);

        // $subscription->client->user->notify(new ClientSubscribedNotification($subscription));

        return redirect()
            ->route('subscriptions.index')
            ->withMessage(__('page.subscriptions.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        $packages = Package::all();

        return view('admin.subscriptions.edit', compact('subscription', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        if ($action = $request->action) {
            if ($action === 'activate') {
                $subscription->update(['status' => 'active']);
            } elseif ($action === 'suspend') {
                $subscription->update(['status' => 'suspended']);
            }
            return back();
        }

        $request->validate(['package_id' => ['required', 'exists:packages,id']]);

        $subscription->update(['package_id' => $request->package_id]);

        return redirect()
            ->route('subscriptions.index')
            ->withMessage(__('page.subscriptions.flash.updated', ['subscription' => $subscription->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $slug = $subscription->slug;

        $subscription->delete();

        return back()->withMessage(__('page.subscriptions.flash.deleted', ['subscription' => $slug]));
    }

    protected function createClientHalls($request)
    {
        foreach ($request->halls as $hall) {
            $hall = Hall::create([
                'name' => $hall['name'],
                'city' => $hall['city'],
                'address' => $hall['address'],
                'capacity' => $hall['capacity'],
                'client_id' => $request->client_id
            ]);
        }
    }
}
