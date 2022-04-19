<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\{
    TenantApiController, CategoryApiController, ProjetoApiController
};

use App\Http\Controllers\Api\Auth\{
    RegisterController, AuthClientController, ResetPasswordController
};
use App\Models\Client;

/*
Route::get('teste', function(){
    $client = User::first();
    $token = $client->createToken('token-teste', ['*']);
    dd($token->plainTextToken);
});
*/

Route::post('/client', [RegisterController::class, 'store']);
Route::post('/sanctum/token', [AuthClientController::class, 'auth']);
/*
* Password Reset
*/
Route::post('/forget-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::get('/auth/cadprojetos', [AuthClientController::class, 'cadprojetos']);
    Route::post('/auth/logout', [AuthClientController::class, 'logout']);
    Route::put('/auth/perfil', [AuthClientController::class, 'perfil']);
    Route::get('/auth/getProjetos', [AuthClientController::class, 'getProjetos']);
    Route::get('/auth/getCategorias', [AuthClientController::class, 'getCategorias']);
    Route::get('/auth/getTipoProjetos', [AuthClientController::class, 'getTipoProjetos']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {

Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);

Route::get('/categories/{url}', [CategoryApiController::class, 'show']);
Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);

Route::get('/projetos', [ProjetoApiController::class, 'projetosByTenant']);

});

/**
 * Test API
 */
Route::get('/', function() {
    return response()
        ->json(['message' => 'ok']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
