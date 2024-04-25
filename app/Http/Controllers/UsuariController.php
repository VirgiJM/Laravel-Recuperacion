<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class UsuariController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Usuari::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'nom' => ['required', 'filled', 'max:50'],
            'email' => ['required', 'unique:usuari,email'],
            'contrasenya' => ['required'],
            'telefon' => ['max:20'],
            // 'validat' => ['nullable'],
            // 'idRol' => ['max:9']
        ];

        $missatges = [
            'filled' => ':attribute no pot estar buit',
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute repetit',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacioInput, $missatges);
        if (!$validacio->fails()) {
            $psw = Hash::make($request->contrasenya);
            // $request->merge(["contrasenya" => $psw]);
            // $request->merge(["rolId" => 1]); // Para asignar el rol cuyo id sea 1.
            // $tupla = Usuari::create($request->all());
            // return response()->json(['result' => $tupla], 200);
            $usuari = new Usuari();
            $usuari-> nom = $request->nom;
            $usuari-> email = $request->email;
            $usuari-> contrasenya = $psw;
            $usuari-> telefon = $request->telefon;
            $usuari-> rolId = 1;
            $usuari-> save();
            return response()->json(['result' => $usuari], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Usuari::findOrFail($id);
            return response()->json(['result' => $tupla], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'id no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        // Es pot controlar el fail (no trobat) de forma genèrica a Exceptions\Handler.php
    }

    public function update(Request $request, string $id)
    {
        $reglesValidacio = [
            'nom' => ['required', 'filled', 'max:50'],
            'email' => ['required', 'unique:usuari,email,' . $id],
            'contrasenya' => ['required'],
            'telefon' => ['max:12'],
        ];

        $missatges = [
            'filled' => ':attribute no pot estar buit',
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute ja està en ús',
            'max' => ':attribute massa llarg',
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $usuari = Usuari::findOrFail($id);
            $usuari->update($request->all());
            return response()->json(['resultat' => $usuari], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuari no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $usuari = Usuari::findOrFail($id);
            $usuari->delete();
            return response()->json(['missatge' => 'Usuari eliminat correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuari no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
