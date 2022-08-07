<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SetPasswordByUserController extends Controller
{
    public function create()
    {
        return view('auth.set-password-by-user');
    }

    public function store(Request $request)
    {
        $request->validate(['password' => ['required', 'confirmed', Password::min(8)]]);

        return Hash::check($request->password, $request->user()->password)
            ? back()->withErrors(['password' => 'Please use another password!'])
            : $request->user()->update(['password' => Hash::make($request->password) ]);
    }
}
