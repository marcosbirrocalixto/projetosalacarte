<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\storeApiClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(storeApiClientRequest $request)
    {
        $data = $request->all();
        //return $data;

        $logado = false;

        $validacao = Validator($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:16'],
           'device_name' => 'required',
        ]);

        if($validacao->fails()){
            //return Response::json([
            //    'erro' => $validacao->errors()
            return [$validacao->errors(), 422];
        }

        $data = $request->all();
        $data['tenant_id'] = 1;
        $data['tipouser_id'] = 1;
        $user = $this->clientService->createNewClient($data);
        $user->token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json($user);
    }
}
