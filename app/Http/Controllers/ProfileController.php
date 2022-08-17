<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $data = [];
        $request->validate([
            'name' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ]);

        if ($request->name) {
            $data['name'] = $request->name;
        }

        if ($request->phone) {
            $data['phone'] = $request->phone;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->photo) {
            $data['photo'] = $request->photo->store('public/images/profiles');
        }

        User::find(auth()->id())->update($data);

        return redirect()->route('profile.show');
    }
}
