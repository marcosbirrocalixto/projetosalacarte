<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProjetoResource;
use App\Services\ProjetoService;
use Illuminate\Http\Request;

class ProjetoApiController extends Controller
{
    protected $projetoService;

    public function __construct(ProjetoService $projetoService)
    {
        $this->projetoService = $projetoService; 
    }

    public function projetosByTenant(TenantFormRequest $request)
    {
        $projetos = $this->projetoService->getProjetosByTenantUuid($request->token_company);

        return ProjetoResource::collection($projetos);
    }
}
