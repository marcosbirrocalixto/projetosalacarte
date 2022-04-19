<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projeto extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['tenant_id', 'user_id', 'client_id', 'name', 'url', 'description', 'orcamento', 'image'];

    public function search($filter = null) 
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get ategorias not linked with this Projeto
     */
    public function categoriasAvailable($filter = null)
    {
        $categorias = Categoria::whereNotIn('categorias.id', function($query) {
            $query->select('categoria_projeto.categoria_id');
            $query->from('categoria_projeto');
            $query->whereRaw("categoria_projeto.projeto_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('categorias.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categorias;
    }

    /**
     * Get ategorias not linked with this Projeto
     */
    public function tipoprojetosAvailable($filter = null)
    {
        //dd('entrou');
        $tipoprojetos = TipoProjeto::whereNotIn('tipo_projetos.id', function($query) {
            $query->select('projeto_tipo_projeto.tipo_projeto_id');
            $query->from('projeto_tipo_projeto');
            $query->whereRaw("projeto_tipo_projeto.projeto_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('tipoprojetos.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $tipoprojetos;
    }

    public function categorias() 
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function tipoprojetos() 
    {
        return $this->belongsToMany(TipoProjeto::class);
    }

    public function details()
    {
        return $this->hasMany(DetailProjeto::class);//Um detalhe pode estar ligado a várias planos
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
