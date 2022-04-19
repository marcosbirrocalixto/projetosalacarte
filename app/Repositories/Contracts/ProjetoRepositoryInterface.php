<?php

namespace App\Repositories\Contracts;

interface ProjetoRepositoryInterface
{
    public function getprojetosByTenantId(int $idTenant);
}