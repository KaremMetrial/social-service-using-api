<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->hasFile('image')) {
            $user->image = $this->handleImageUpload($request, $user);
            $user->save();
        }

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ]);
    }

    private function handleImageUpload(RegisterRequest $request, User $user): string
    {
        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;

        return $request->file('image')->storeAs(
            "profile_images/{$user->username}",
            $filename,
            'public'
        );
    }
}
