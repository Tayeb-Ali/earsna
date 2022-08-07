<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
