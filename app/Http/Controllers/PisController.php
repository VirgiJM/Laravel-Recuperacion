<?php

namespace App\Http\Controllers;

use App\Models\Pis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class PisController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Pis::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'edificiId' => ['required', 'unique:pis,edificiId'],

        ];

        $missatges = [
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute repetit',
        ];

        $validacio = Validator::make($request->all(), $reglesValidacioInput, $missatges);
        if (!$validacio->fails()) {
            $tupla = Pis::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Pis::findOrFail($id);
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
            'edificiId' => ['required', 'unique:pis,edificiId,' . $id],
        ];

        $missatges = [
            'required' => 'Atribut :attribute requerit',
            'unique' => ':attribute ja està en ús',
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $pis = Pis::findOrFail($id);
            $pis->update($request->all());
            return response()->json(['resultat' => $pis], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Pis no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $pis = Pis::findOrFail($id);
            $pis->delete();
            return response()->json(['missatge' => 'Pis eliminat correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Pis no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
