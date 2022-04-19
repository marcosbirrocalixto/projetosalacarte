<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use App\Models\TipoProjeto;
use Illuminate\Http\Request;

class ProjetoTipoProjetoController extends Controller
{
    protected $projeto, $tipoprojeto;

    public function __construct(Projeto $projeto, TipoProjeto $tipoprojeto)
    {
        $this->projeto = $projeto;
        $this->tipoprojeto = $tipoprojeto;

        //$this->middleware(['can:projetotipoprojeto']);
    }

    public function tipoprojetos($idProjeto)
    {
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }        
        //dd('entrou');
        $tipoprojetos = $projeto->tipoprojetos()->paginate();

        //dd($tipoprojetos);

        return view('admin.pages.projetos.tipoprojetos.index', compact('projeto', 'tipoprojetos'));
    }


    public function projetos($idTipoProjeto)
    {
        if (!$tipoprojeto = $this->tipoprojeto->find($idTipoProjeto)) {
            return redirect()->back();
        }

        $projetos = $tipoprojeto->projetos()->paginate();

        return view('admin.pages.tipoprojetos.projetos.projetos', compact('tipoprojeto', 'projetos'));
    }


    public function tipoprojetosAvailable(Request $request, $idProjeto)
    {
        //dd('entrou');
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $tipoprojetos = $projeto->tipoprojetosAvailable($request->filter);

        return view('admin.pages.projetos.tipoprojetos.available', compact('projeto', 'tipoprojetos', 'filters'));
    }


    public function attachTipoProjetosProjeto(Request $request, $idProjeto)
    {
        if (!$projeto = $this->projeto->find($idProjeto)) {
            return redirect()->back();
        }

        if (!$request->tipoprojetos || count($request->tipoprojetos) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um Projeto');
        }
        //dd($projeto);
        $projeto->tipoprojetos()->attach($request->tipoprojetos);

        return redirect()->route('projetos.tipoprojetos', $projeto->id);
    }

    public function detachTipoProjetoProjeto($idProjeto, $idTipoProjeto)
    {
        $projeto = $this->projeto->find($idProjeto);
        $tipoprojeto = $this->tipoprojeto->find($idTipoProjeto);

        if (!$projeto || !$tipoprojeto) {
            return redirect()->back();
        }

        $projeto->tipoprojetos()->detach($tipoprojeto);

        return redirect()->route('projetos.tipoprojetos', $projeto->id);
    }
}
