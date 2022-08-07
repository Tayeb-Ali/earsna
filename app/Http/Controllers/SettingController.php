<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Hall;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function __construct()
    {
        if (!Session::get('hall')) {
            return redirect()->route('halls.index');
        }
    }
    public function index()
    {
        if (session()->has('hall')) {
            $settings = Setting::where('hall_id', Session::get('hall')->id)->get();

            return view('settings', compact('settings'));
        } else {
            return view('settings');
        }
    }

    public function update(UpdateSettingRequest $request, Hall $hall)
    {
        foreach ($request->validated() as $value) {
            if ($value !== null) {
                break;
            }
            return back()->withErrors(['no-setting' => 'لم يتم إدخال أي قيمة']);
        }

        if ($request->has('hall_name')) {
            $hall->update(['name' => $request->hall_name]);
            session()->put('hall', $hall);
        }

        if ($request->has('days_before_booking_due_date')) {
            Setting::where('name', 'days_before_booking_due_date')
                ->where('hall_id', $hall->id)
                ->first()
                ->update(['value' => $request->days_before_booking_due_date]);
        }

        return back()->withMessage('Settings updated');
    }
}
