<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login (Request $request)
    {
    $loginData = $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
    $user =User::where('email', $loginData['email'])->first();
    //cek user
    if(!$user){
        return response(['message'=>'invalid credentials'],401);
    }
    //cek password
    if(!Hash::check($loginData['password'], $user->password)){
        return response(['message'=>'invalid credentials'],401);
    }
    $token =$user->createToken('auth_token')->plainTextToken;

    return response(['user'=>$user,'token'=>$token],200);
    }
    //logout
    public function logout (Request $request)
    {
    $request->user()->currentAccessToken()->Delete();

    return response(['message'=> 'Logged Out'],200);
    }
    //update image profile & face_embedding
    public function updateprofile(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding' => 'required',
        ]);

        $user = $request->user();
        $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        // //save image
        $image->storeAs('public/images', $image->hashName());
        $user->image_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        return response([
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }

    //update fcm token
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required',
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response([
            'message' => 'FCM token updated',
        ], 200);
    }
}
