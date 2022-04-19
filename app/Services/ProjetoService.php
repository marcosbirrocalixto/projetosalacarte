<?php

namespace App\Services;

use App\Repositories\Contracts\ProjetoRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProjetoService
{
    protected $projetoService, $tenantRepository;

    public function __construct(
        ProjetoRepositoryInterface $projetoService,
        TenantRepositoryInterface $tenantRepository
    ) {
        $this->projetoService = $projetoService;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProjetosByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->projetoService->getprojetosByTenantId($tenant->id);
    }
}