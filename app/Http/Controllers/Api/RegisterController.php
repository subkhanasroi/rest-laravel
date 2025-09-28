<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming register request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

       $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => $request->password, 
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'user'    => $user,
        ], 201);
    }
}
