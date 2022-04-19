<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoProjetoRequest;
use App\Models\TipoProjeto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TipoProjetoController extends Controller
{
    private $repository;

    public function __construct(TipoProjeto $tipoProjeto) 
    {
        $this->repository = $tipoProjeto;

        //$this->middleware(['can:tipoprojeto']);
    }

    public function index() 
    {
        $tipoProjetos = $this->repository->orderBy('name')->paginate();

        return view('admin.pages.tipoprojetos.index', [
            'tipoProjetos' => $tipoProjetos            
        ]);
    }

    public function create() 
    {
        return view('admin.pages.tipoprojetos.create');
    }

    public function store(StoreUpdateTipoProjetoRequest $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $this->repository->create($data);

        return redirect()->route('tipoprojetos.index')
            ->with('message', 'Registro cadastrado com sucesso!');
    }

    public function show($url)
    {
        $tipoProjeto = $this->repository->where('url', $url)->first();

        if (!$tipoProjeto)
            return redirect()->back();

        return view('admin.pages.tipoprojetos.show', [
            'tipoProjeto' => $tipoProjeto
        ]);
    }

    public function delete($url)
    {
        $tipoProjeto = $this->repository
                ->where('url', $url)
                ->first();

        if (!$tipoProjeto)
            return redirect()->back();
   
        $tipoProjeto->delete();

        return redirect()->route('tipoprojetos.index')
                        ->with('message', 'Registro deletado com sucesso!');

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tipoProjetos = $this->repository->search($request->filter);

        return view('admin.pages.tipoprojetos.index', [
            'tipoProjetos' => $tipoProjetos,
            'filters' => $filters,
        ]);
    }


    public function edit($url)
    {
        $tipoProjeto = $this->repository->where('url', $url)->first();

        if (!$tipoProjeto)
            return redirect()->back();

        return view('admin.pages.tipoprojetos.edit', [
            'tipoProjeto' => $tipoProjeto,
        ]);
    }

    public function update(StoreUpdateTipoProjetoRequest $request, $url)
    {
        $tipoProjeto = $this->repository->where('url', $url)->first();

        if (!$tipoProjeto)
            return redirect()->back();

        $tipoProjeto->update($request->all());

        return redirect()->route('tipoprojetos.index')
            ->with('message', 'Registro alterado com sucesso!');
    }
}
