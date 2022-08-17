<?php

namespace App\Http\Controllers\Admin;

use App\Events\CreatedClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewClientRequest;
use App\Models\Admin\{BusinessField, Client};
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class ClientController extends Controller
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $clients = Client::with('user')->get();
//    latest()->paginate(30);
        $clients->append('user');
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $business_fields = BusinessField::all();

        $redirect = request()->has('redirect') ? request()->redirect : null;

        return view('admin.clients.create', compact('business_fields', 'redirect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewClientRequest $request
     * @return RedirectResponse
     */
    public function store(NewClientRequest $request)
    {
        $client = Client::create($request->only(['address', 'business_field_id']));

        $this->createClientUser($request, $client);

        event(new CreatedClient($client));

        return $request->redirect
            ? redirect()->route($request->redirect)
            : redirect()->route('clients.index')->withMessage(__('page.clients.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Application|Factory|View
     */
    public function edit(Client $client)
    {
        $businessFields = BusinessField::all();
        return view('admin.clients.edit', compact('client', 'businessFields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->only(['address', 'business_field_id']));
        if ($request->has('password')) {
            $input = $request->only(['name', 'email', 'phone', 'password']);
        } else {
            $input = $request->only(['name', 'email', 'phone']);
        }
        $client->user->update($input);
        return redirect()->route('clients.index')->withMessage(__('page.clients.flash.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return Response
     */
    public function destroy(Client $client)
    {
        $name = $client->user->name;

        foreach ($client->halls as $hall) {
            $hall->delete();
        }

        $client->subscription->delete();

        $client->user->delete();

        $client->delete();

        return redirect()->route('clients.index')
            ->withMessage(__('page.clients.flash.deleted', ['client' => $name]));
    }

    protected function createClientUser($request, $client)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'client_id' => $client->id,
            'password' => $request->password,
        ]);

        $client->update(['user_id' => $user->id]);

        $permissions = Permission::where('type', 'client')
            ->orWhere('type', 'both')
            ->pluck('name')
            ->toArray();

        $user->givePermissionTo($permissions);
    }
}
