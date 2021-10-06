<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{


    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'family_name' => 'required',
            'given_name' => 'required',
            'password' => 'required'
        ]);

        $exists = User::where('email', $request->email)->exists();

        if($exists){
            return response()->json(['errors' => "Utilisateur déjà inscrit"], 409);
        }


        $user = User::create([
            'email' => $request->email,
            'family_name' => $request->family_name,
            'given_name' => $request->given_name,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token
        ], 201);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['errors' => "Identifiants inconnus ou erronés"], 401);
        }

        $user->tokens()->where('tokenable_id', $user->id)->delete();

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' =>$user
        ], 200);
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => 'Déconnecté'
        ], 204);
    }

    public function me(Request $request)
    {

        return response()->json([
            'id' => $request->user()->id,
            'created_at' => $request->user()->created_at,
            'updated_at' => $request->user()->updated_at,
            'family_name' => $request->user()->family_name,
            'given_name' => $request->user()->family_name,
            'email' => $request->user()->email
        ], 200);
    }

}
