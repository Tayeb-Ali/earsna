<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\ControllerRepository;
use DB;
use Exception;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class AuthAPIController extends ControllerRepository
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = $this->model::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken($request->email)->plainTextToken;
            if ($user) {
//                $user->tokens()->where('id', '!=' ,$user->currentAccessToken()->id)->delete();
                $cookie = cookie('jwt', $token, 60 * 24);
                return response()->json(
                    [
                        'data' => $user,
                        'token' => $token,
                        'status' => true,
                        'message' => "Login Successful",
                    ], 201)->withCookie($cookie);
            }
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'data' => $e->getMessage(),
                    'status' => false,
                    'message' => 'User not found'
                ], 200);

        } catch (Exception $e) {
            return response()->json(
                [
                    'data' => $e,
                    'status' => false,
                    'message' => 'User not found'
                ], 200);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'phone' => 'required|unique:users',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'data' => $validator->errors()->all(),
                    'status' => false
                ], 401);
            }

            DB::beginTransaction();
            $user = $this->model::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' =>$request->password,
            ]);

            $token = $user->createToken($request->email)->plainTextToken;
            DB::commit();
            $cookie = cookie('jwt', $token, 60 * 24);

            return response()->json(
                [
                    'data' => $user,
                    'token' => $token,
                    'status' => true,
                    'message' => 'User created successfully'
                ], 201)->withCookie($cookie);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'devMessage' => $e->getMessage() . 'line: ' . $e->getLine(),
                    'status' => false,
                    'message' => 'User not created'
                ]);
        }
    }

    public function checkToken()
    {
        // check if token is valid using Laravel sanctum package
        try {
            $user = auth()->user();
            if (isset($user)) {

                return response()->json(
                    [
                        'data' => $user->id,
                        'status' => true,
                        'message' => 'Token is valid'
                    ], 201);
            }
            return response()->json(
                [
                    'data' => $user,
                    'status' => false,
                    'message' => 'Token is invalid'
                ], 200);
        } catch (Exception $e) {
            return response()->json(
                [
                    'data' => $e,
                    'status' => false,
                    'message' => 'Token is invalid'
                ], 200);
        }
    }

//    create login method using Laravel Sanctum package
    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        $name = auth()->user()->name;
        try {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
            return response()->json(
                [
                    'data' => "$name logged out successfully",
                    'status' => true,
                    'message' => 'Logout Successful'
                ], 201);
        } catch (Exception $e) {
            return response()->json(
                [
                    'data' => $e,
                    'status' => false,
                    'message' => 'Logout Failed'
                ], 200)->withCookie($cookie);;
        }
    }

    //    create get user data method using Laravel Sanctum
    public function user()
    {
        try {
            $user = auth()->user();
            return response()->json(
                [
                    'data' => $user,
                    'status' => true,
                    'message' => 'User data'
                ], 201);
        } catch (Exception $e) {
            return response()->json(
                [
                    'data' => $e,
                    'status' => false,
                    'message' => 'User data'
                ], 200);
        }
    }


}