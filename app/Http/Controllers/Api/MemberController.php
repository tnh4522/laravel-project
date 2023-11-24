<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class MemberController extends Controller
{
    public $successStatus = 200;
    protected function doLogin($attempt, $remember)
    {
        if (Auth::attempt($attempt, $remember)) {
            return true;
        }
        return false;
    }
    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0 || 1 || 2
        ];
        $remember = false;
        if($request->remember_me) {
            $remember = true;
        }
        if($this->doLogin($login, $remember)) {
            $user = Auth::user();
            $token = $user?->createToken('token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'data' => $user,
                'token' => $token
            ],
            $this->successStatus
            );
        }
        return response()->json([
            'status' => 'error',
            'error' => 'invalid email or password'
        ],
        $this->successStatus
        );
    }
    public function register(RegisterRequest $request)
    {
        $user = User::all()->toArray();
        $data = $request->all();
        $file = $request->file('avatar');
        if($file) {
            $image = $file;
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $data['avatar'] = $name;
        }
        $data['password'] = bcrypt($data['password']);
        if($getUser = User::create($data)) {
            if($file) {
                Image::make($file)->save(public_path('upload/user/avatar/').$data['avatar']);
            }
            return response()->json([
                'status' => 200,
                'data' => $getUser,
            ], JsonResponse::HTTP_OK);
        }
        return response()->json([
            'status' => 404,
            'error' => 'register failed'
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
    public function update(RegisterRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $file = $request->file('avatar');
        if($file) {
            $image = $file;
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $data['avatar'] = $name;
        }
        $data['password'] = bcrypt($data['password']);
        if($user->update($data)) {
            if($file) {
                Image::make($file)->save(public_path('upload/user/avatar/').$data['avatar']);
            }
            return response()->json([
                'status' => 200,
                'data' => $user,
            ], JsonResponse::HTTP_OK);
        }
        return response()->json([
            'status' => 404,
            'error' => 'update failed'
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
