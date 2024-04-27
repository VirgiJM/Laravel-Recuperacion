<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Add this line to import the Hash facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class AulaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');    //ACTIVAM MIDDLEWARE DE AUTENTICACIÓ
    }
    public function index()
    {
        $tuples = Aula::all();
        return response()->json(['result' => $tuples], 200);
    }

    public function store(Request $request)
    {
        $reglesValidacioInput = [
            // 'idEdifici' => ['required'],
            // 'idPis' => ['required'],
            // 'idAula' => ['required'],
            // 'descripcio' => ['max:50'],
            'pisId' => ['required'],
            'codiAula' => ['required'],
            'descripcio' => ['max:150']

        ];

        $missatges = [
            'required' => 'Atribut :attribute requerit',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacioInput, $missatges);
        if (!$validacio->fails()) {
            $tupla = Aula::create($request->all());
            return response()->json(['result' => $tupla], 200);
        } else {
            return response()->json(['error' => $validacio->errors()], 400); // Bad Request
        }
    }

    public function show(string $id)
    {
        try {
            $tupla = Aula::findOrFail($id);
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
            /*'idEdifici' => ['required'],
            'idPis' => ['required'],
            'idAula' => ['required'],
            'descripcio' => ['max:50'],*/
            'pisId' => ['required'],
            'codiAula' => ['required'],
            'descripcio' => ['max:150']
        ];

        $missatges = [
            'required' => 'Atribut :attribute requerit',
            'max' => ':attribute massa llarg'
        ];

        $validacio = Validator::make($request->all(), $reglesValidacio, $missatges);

        if ($validacio->fails()) {
            return response()->json(['error' => $validacio->errors()], 400);
        }

        try {
            $aula = Aula::findOrFail($id);
            $aula->update($request->all());
            return response()->json(['resultat' => $aula], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Aula no trobada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $aula = Aula::findOrFail($id);
            $aula->delete();
            return response()->json(['missatge' => 'Aula eliminada correctament'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Aula no trobada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
