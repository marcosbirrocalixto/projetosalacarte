<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categorias';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categorias.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categorias.*')
            ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                    ->where('tenant_id', $idTenant)
                    ->get();
    }

    public function getCategoryByUrl(string $url)
    {
        return DB::table($this->table)
                    ->where('url', $url)
                    ->first();
    }

}