<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;

    use TenantTrait;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'url', 'description'];

    public function search($filter = null) 
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get Projetos
     */
    public function projetos() {
        return $this->belongsToMany(Projeto::class);
    }
}
