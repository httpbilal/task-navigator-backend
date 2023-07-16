<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usersandtasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
            'image' => 'nullable|base64image',
            'tasks' => 'nullable|integer',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $imagePath = $this->saveImageFromBase64($request->input('image')); // Convert base64 to image path

            $user = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'image' => $imagePath, // Store the image path
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            if ($user) {
                return response()->json(['user' => $user], 201);
            } else {
                return response()->json(['error' => 'Failed to register user'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'image' => 'nullable|base64image', // Use the custom validation rule for base64 images
            'tasks' => 'nullable|integer',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->has('image')) {
            $user->image = $this->saveImageFromBase64($request->input('image')); // Convert base64 to image path and update
        }

        $user->update($request->all());

        return response()->json(['user' => $user, 'message' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    private function saveImageFromBase64($imageData)
    {
        if ($imageData) {
            // Generate a unique filename for the image
            $filename = uniqid() . '.png';

            // Get the base64 data from the image data string
            $base64Image = explode(',', $imageData, 2)[1];

            // Decode the base64 data
            $decodedImage = base64_decode($base64Image);

            // Save the image to the storage/app directory using the Storage facade
            Storage::put('images/' . $filename, $decodedImage);

            return 'images/' . $filename;
        }
        return null;
    }

}
