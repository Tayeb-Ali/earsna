<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewAdvertisementRequest;
use App\Http\Requests\Admin\UpdateAdvertisementRequest;
use App\Models\Admin\BusinessField;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::latest()->paginate(30);

        return view('admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business_fields = BusinessField::all();

        return view('admin.advertisements.create', compact('business_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewAdvertisementRequest $request)
    {
        $data = $request->except('images');

        if ($request->has('images')) {
            $images = [];

            foreach ($request->images as $image) {
                $images[] = $image->store('images/advertisements');
            }

            $data['images'] = json_encode($images);
        }

        Advertisement::create($data);

        return redirect()->route('advertisements.index')
            ->withMessage(__('page.advertisements.flash.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return view('admin.advertisements.show', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        $business_fields = BusinessField::all();

        return view('admin.advertisements.edit', compact('business_fields', 'advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        $advertisement->update($request->except('images'));

        if ($request->has('images')) {
            $images = [];

            foreach (json_decode($advertisement->images) as $image) {
                if (File::exists($image)) {
                    File::delete($image);
                }
            }

            foreach ($request->images as $image) {
                $images[] = $image->store('images/advertisements');
            }

            $advertisement->images = json_encode($images);
        }

        return redirect()->route('advertisements.index')
            ->withMessage(__('page.advertisements.flash.updated', ['advertisement' => $advertisement->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $name = $advertisement->name;

        $advertisement->delete();

        return redirect()->route('advertisements.index')
            ->withMessage(__('page.advertisements.flash.deleted', ['advertisement' => $name]));
    }
}
