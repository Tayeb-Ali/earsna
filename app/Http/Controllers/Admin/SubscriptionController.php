<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\NewSubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\Package;
use App\Models\Admin\Subscription;
use App\Models\Hall;
use App\Notifications\ClientSubscribedNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Session;
use function PHPUnit\Framework\isEmpty;

class SubscriptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $subscriptions = Subscription::latest()->paginate(30);

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        $subs = Subscription::all()->pluck('client_id');
         $clients = Client::whereNotIn('id', $subs)->get();
        if ($clients->isEmpty()) {
            notify()->info('no New User yeit');
            return redirect()->back();
        }
        $packages = Package::all();

        return view('admin.subscriptions.create', compact('clients', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewSubscriptionRequest $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(NewSubscriptionRequest $request)
    {
//        return $request->all();
        try {
            DB::beginTransaction();
            $subscription = Subscription::where('client_id', $request->client_id)->first();
            if (isset($subscription)) {
                notify()->error('is Subscription before ⚡️');
                return redirect()->back();
            }
            $subscription = Subscription::create([
                'client_id' => $request->client_id,
                'package_id' => $request->package_id
            ]);
//            $this->createClientHalls($request);
            $subscription->client->user->notify(new ClientSubscribedNotification($subscription));
            DB::commit();
            notify()->success(__('page.subscriptions.flash.created'));
            return redirect()
                ->route('subscriptions.index');

        } catch (\Exception $e) {
            DB::rollBack();
            notify()->error($e->getMessage() . ' ⚡️');
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            notify()->error($e->getMessage() . ' ⚡️');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscription $subscription
     * @return Application|Factory|View
     */
    public function edit(Subscription $subscription)
    {
        $packages = Package::all();

        return view('admin.subscriptions.edit', compact('subscription', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subscription $subscription
     * @return RedirectResponse
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
     * @param Subscription $subscription
     * @return Response
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
