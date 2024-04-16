<?php

namespace App\Http\Controllers;

use App\Models\Documententrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class DocumentEntradaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = DocumentEntrada::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            'data' => ['required', 'filled'],
            'observacions' => ['max:250'],
            'ref' => ['required'],
            'pdf' => ['required', 'boolean'], // Es boolean
            'url_pdf' => ['required', 'max:75'],
            'idProveidor' => ['required']
             
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
            $request->merge(["contrasenya" => $psw]);
            $tupla = DocumentEntrada::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = DocumentEntrada::findOrFail($id);
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
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
