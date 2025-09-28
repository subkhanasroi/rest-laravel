<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List semua user',
            'data'    => $users
        ], 200);
    }

    public function uploadPhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Photo updated',
            'user'    => $user
        ]);
    }
}
