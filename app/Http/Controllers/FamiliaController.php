<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class FamiliaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Familia::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'nom' => ['required', 'filled', 'max:50', 'unique:familia,nom'],
        ];

        $missatges = [
            'filled' => ':attribute no pot estar buit',
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute repetit',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacioInput, $missatges);
        if (!$validacio->fails()) {
            $tupla = Familia::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Familia::findOrFail($id);
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
            'nom' => ['required', 'filled', 'max:50', 'unique:familia,nom,' . $id],
        ];

        $missatges = [
            'filled' => ':attribute no pot estar buit',
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute ja està en ús',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $familia = Familia::findOrFail($id);
            $familia->update($request->all());
            return response()->json(['resultat' => $familia], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Família no trobada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $familia = Familia::findOrFail($id);
            $familia->delete();
            return response()->json(['missatge' => 'Família eliminada correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Família no trobada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
