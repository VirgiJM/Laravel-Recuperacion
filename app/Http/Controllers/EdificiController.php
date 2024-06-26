<?php

namespace App\Http\Controllers;

use App\Models\Edifici;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class EdificiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Edifici::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'descripcio' => ['max:50']
        ];

        $missatges = [
            // 'filled' => ':attribute no pot estar buit',
            // 'required' => 'Atribut :attribute requerit',
            // 'unique' => ':attribute repetit',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacioInput, $missatges);
        if (!$validacio->fails()) {
            $tupla = Edifici::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Edifici::findOrFail($id);
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
            'descripcio' => ['max:50']
        ];

        $missatges = [
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $edifici = Edifici::findOrFail($id);
            $edifici->update($request->all());
            return response()->json(['resultat' => $edifici], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Edifici no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $edifici = Edifici::findOrFail($id);
            $edifici->delete();
            return response()->json(['missatge' => 'Edifici eliminat correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Edifici no trobat'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
