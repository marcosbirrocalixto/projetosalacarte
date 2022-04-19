<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoCategoriaController extends Controller
{
    protected $projeto, $categoria;

    public function __construct(Projeto $projeto, Categoria $categoria)
    {
        $this->projeto = $projeto;
        $this->categoria = $categoria;

        //$this->middleware(['can:ProjetoCategoria']);
    }

    public function categorias($idProjeto)
    {
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }

        $categorias = $projeto->categorias()->paginate();

        return view('admin.pages.projetos.categorias.index', compact('projeto', 'categorias'));
    }


    public function projetos($idCategoria)
    {
        if (!$categoria = $this->categoria->find($idCategoria)) {
            return redirect()->back();
        }

        $projetos = $categoria->projetos()->paginate();

        return view('admin.pages.categorias.projetos.projetos', compact('categoria', 'projetos'));
    }


    public function categoriasAvailable(Request $request, $idProjeto)
    {
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $categorias = $projeto->categoriasAvailable($request->filter);

        return view('admin.pages.projetos.categorias.available', compact('projeto', 'categorias', 'filters'));
    }


    public function attachCategoriasProjeto(Request $request, $idProjeto)
    {
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }

        if (!$request->categorias || count($request->categorias) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um Projeto');
        }

        $projeto->categorias()->attach($request->categorias);

        return redirect()->route('projetos.categorias', $projeto->id);
    }

    public function detachCategoriaProjeto($idProjeto, $idCategoria)
    {
        $projeto = $this->projeto->find($idProjeto);
        $categoria = $this->categoria->find($idCategoria);

        if (!$projeto || !$categoria) {
            return redirect()->back();
        }

        $projeto->categorias()->detach($categoria);

        return redirect()->route('projetos.categorias', $projeto->id);
    }
}
