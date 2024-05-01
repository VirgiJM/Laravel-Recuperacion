<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\DocumentEntradaController;
use App\Http\Controllers\EdificiController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\GestionaController;
use App\Http\Controllers\PisController;
use App\Http\Controllers\ProveeidorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuariController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// $router->post('login', [LoginController::class, 'login']);
$router->post('registre', [UsuariController::class, 'registre']);
$router->get('confirma/{token}', [UsuariController::class, 'confirma']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
$router->group(['prefix' => 'usuari'], function () use ($router) {
    $router->get('', [UsuariController::class, 'index']);
    $router->get('{id}', [UsuariController::class, 'show']);
    $router->post('', [UsuariController::class, 'store']);
    $router->put('{id}', [UsuariController::class, 'update']);
    $router->delete('{id}', [UsuariController::class, 'delete']);
});

$router->group(['prefix' => 'article'], function () use ($router) {
    $router->get('', [ArticleController::class, 'index']);
    $router->get('{id}', [ArticleController::class, 'show']);
    $router->post('', [ArticleController::class, 'store']);
    $router->put('{id}', [ArticleController::class, 'update']);
    $router->delete('{id}', [ArticleController::class, 'delete']);
});
$router->group(['prefix' => 'documententrada'], function () use ($router) {
    $router->get('', [DocumentEntradaController::class, 'index']);
    $router->get('{id}', [DocumentEntradaController::class, 'show']);
    $router->post('', [DocumentEntradaController::class, 'store']);
    $router->put('{id}', [DocumentEntradaController::class, 'update']);
    $router->delete('{id}', [DocumentEntradaController::class, 'delete']);
});
$router->group(['prefix' => 'aula'], function () use ($router) {
    $router->get('', [AulaController::class, 'index']);
    $router->get('{id}', [AulaController::class, 'show']);
    $router->post('', [AulaController::class, 'store']);
    $router->put('{id}', [AulaController::class, 'update']);
    $router->delete('{id}', [AulaController::class, 'delete']);
})/*->middleware('checktoken')*/; // Ese Middleware hará que si no tienes token no te dejará mriar esa tabla. Se puede poner en un get, en un post, en un put o en un delete.
$router->group(['prefix' => 'edifici'], function () use ($router) {
    $router->get('', [EdificiController::class, 'index']);
    $router->get('{id}', [EdificiController::class, 'show']);
    $router->post('', [EdificiController::class, 'store']);
    $router->put('{id}', [EdificiController::class, 'update']);
    $router->delete('{id}', [EdificiController::class, 'delete']);
});
$router->group(['prefix' => 'familia'], function () use ($router) {
    $router->get('', [FamiliaController::class, 'index']);
    $router->get('{id}', [FamiliaController::class, 'show']);
    $router->post('', [FamiliaController::class, 'store']);
    $router->put('{id}', [FamiliaController::class, 'update']);
    $router->delete('{id}', [FamiliaController::class, 'delete']);
});
$router->group(['prefix' => 'gestiona'], function () use ($router) {
    $router->get('', [GestionaController::class, 'index']);
    $router->get('{id}', [GestionaController::class, 'show']);
    $router->post('', [GestionaController::class, 'store']);
    $router->put('{id}', [GestionaController::class, 'update']);
    $router->delete('{id}', [GestionaController::class, 'delete']);
});
$router->group(['prefix' => 'pis'], function () use ($router) {
    $router->get('', [PisController::class, 'index']);
    $router->get('{id}', [PisController::class, 'show']);
    $router->post('', [PisController::class, 'store']);
    $router->put('{id}', [PisController::class, 'update']);
    $router->delete('{id}', [PisController::class, 'delete']);
});
$router->group(['prefix' => 'proveeidor'], function () use ($router) {
    $router->get('', [ProveeidorController::class, 'index']);
    $router->get('{id}', [ProveeidorController::class, 'show']);
    $router->post('', [ProveeidorController::class, 'store']);
    $router->put('{id}', [ProveeidorController::class, 'update']);
    $router->delete('{id}', [ProveeidorController::class, 'delete']);
});
$router->group(['prefix' => 'rol'], function () use ($router) {
    $router->get('', [RolController::class, 'index']);
    $router->get('{id}', [RolController::class, 'show']);
    $router->post('', [RolController::class, 'store']);
    $router->put('{id}', [RolController::class, 'update']);
    $router->delete('{id}', [RolController::class, 'delete']);
});
