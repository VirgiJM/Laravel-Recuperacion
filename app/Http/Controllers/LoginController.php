<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = Usuari::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('contrasenya'), $user->contrasenya) && $user->validat != '') {
            $apikey = base64_encode(Str::random(40));
            $user["api_token"] = $apikey;
            $user->save();
            return response()->json(['result' => ["token" => $apikey, "usuari" => $user]], 200);
        } else {
            return response()->json(['error' => 'fail'], 401);
        }
    }

    public function logout($email)
    {
        $user = Usuari::where('email', $email)->first();
        if ($user) {
            $user->token = '';
            $user->save();
            return response()->json(['resultat' => 'OK'], 200);
        } else {
            return response()->json(['error' => 'Email no trobat'], 404);
        }
    }
}
