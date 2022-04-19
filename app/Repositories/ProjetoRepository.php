<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProjetoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProjetoRepository implements ProjetoRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'projetos';
    }

    public function getprojetosByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                        ->where('tenant_id', $idTenant) 
                        ->get();
    }

}