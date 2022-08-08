<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;

//use DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ControllerRepository extends Controller
{
    protected $model;
    protected $name;

    public function __construct($model)
    {
//        $this->middleware('auth');
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->has('lang_key')) {
            $data = $this->model->where('lang_key', $request->lang_key)
                ->latest()
                ->get();
            return response()->json(
                [
                    'data' => $data,
                    'status' => true,
                    'message' => 'Data retrieved successfully'
                ]);
        }
        $data = $this->model->latest()->get();
        return response()->json(
            [
                'data' => $data,
                'status' => false,
                'message' => 'Data not found'
            ]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function paginate(Request $request): JsonResponse
    {
        $data = $this->model
            ->latest()
            ->where('lang_key', $request->lang_key)
            ->paginate(20);
        $data['status'] = true;
        $data['message'] = "Data retrieved successfully";
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(
                [
                    'data' => $data,
                    'status' => false,
                    'message' => 'Data not found'
                ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $data = $this->model->create($request->all());
            if ($data) {
                if ($request->hasFile('images') && $request->file('images')->isValid()) {
                    $data->addMediaFromRequest('images')->toMediaCollection('images');
                }
                \DB::commit();
                return response()->json(
                    [
                        'data' => $data,
                        'status' => true,
                        'message' => 'Data created successfully'
                    ]);
            } else {
                return response()->json(
                    [
                        'data' => $data,
                        'status' => false,
                        'message' => 'Data not created'
                    ]);
            }
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(
                [
                    'devMessage' => $e->getMessage() . 'line: ' . $e->getLine(),
                    'status' => false,
                    'message' => 'Data not created'
                ]);
        }
//        });
    }


    /**
     * Display the specified resource.
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = $this->model->find($id);
        if ($data) {
            return response()->json(
                [
                    'data' => $data,
                    'status' => false,
                    'message' => 'Data retrieved successfully'
                ]);
        } else {
            return response()->json(
                [
                    'data' => $data,
                    'status' => true,
                    'message' => 'Data not found'
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->update($request->all());
            return response()->json(
                [
                    'data' => $model,
                    'status' => false,
                    'message' => 'Data retrieved successfully'
                ]);
        } else {
            return response()->json(
                [
                    'data' => $model,
                    'status' => true,
                    'message' => 'Data not found'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
            return response()->json(
                [
                    'data' => $model,
                    'status' => false,
                    'message' => 'Data retrieved successfully'
                ]);
        } else {
            return response()->json(
                [
                    'data' => $model,
                    'status' => true,
                    'message' => 'Data not found'
                ]);
        }
    }

    public function search(): JsonResponse
    {
        $data = $this->model->latest()
            ->filter(request(['search', 'description', 'meta_description']))
            ->paginate(20);
        if ($data) {
            response()->json(
                [
                    'data' => $data,
                    'status' => true,
                    'message' => 'Data retrieved successfully'
                ]);
        }
        return response()->json(
            [
                'data' => $data,
                'status' => false,
                'message' => 'Data not found'
            ]);
    }
}