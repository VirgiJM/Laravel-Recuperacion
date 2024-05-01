<?php

namespace App\Http\Controllers;

use App\Models\Proveeidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class ProveeidorController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Proveeidor::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'nom' => ['required', 'filled', 'max:50', 'unique:proveeidor,nom'],
            'nif' => ['required', 'filled', 'max:20', 'unique:proveeidor,nif'],
            'email' => ['required', 'unique:proveeidor,email'],
            'telefon' => ['required', 'filled', 'max:25', 'unique:proveeidor,telefon'],



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
            $tupla = Proveeidor::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Proveeidor::findOrFail($id);
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
            'nom' => ['filled', 'max:50', 'unique:proveeidor,nom,' . $id],
            'nif' => ['filled', 'max:20', 'unique:proveeidor,nif,' . $id],
            'email' => ['email', 'unique:proveeidor,email,' . $id],
            'telefon' => ['filled', 'max:25', 'unique:proveeidor,telefon,' . $id],
        ];

        $missatges = [
            'filled' => ':attribute no pot estar buit',
            'unique' => ':attribute ja està en ús',
            'max' => ':attribute és massa llarg',
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $proveidor = Proveeidor::findOrFail($id);
            $proveidor->update($request->all());
            return response()->json(['resultat' => $proveidor], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Proveïdor no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $proveidor = Proveeidor::findOrFail($id);
            $proveidor->delete();
            return response()->json(['missatge' => 'Proveïdor eliminat correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Proveïdor no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
