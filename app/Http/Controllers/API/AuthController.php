<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Requests\StoreLoginRequest;
use App\Repositories\UserRepository;
use App\Models\User;

class AuthController extends Controller
{
    public function login(StoreLoginRequest $request)
    {
        $user = UserRepository::getOneByWhere(array(['email', $request->email]));

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('appToken')->plainTextToken;

        return Response::sendResponse([
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->getRoleNames(),
                'permissions' => $user->getAllPermissions(),
            ],
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return Response::sendResponse([], 'Logged out successfully');
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function checkIfHasPermission($permission)
    {
        return auth()->user()->hasAnyPermission([$permission]);
    }
}
