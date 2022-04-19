<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProjetoRequest;
use App\Models\Projeto;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjetoController extends Controller
{
    private $repository;

    use TenantTrait;

    public function __construct(Projeto $projeto) 
    {
        $this->repository = $projeto;

        //$this->middleware(['can:projeto']);
    }

    public function index() 
    {
        $projetos = $this->repository->orderBy('name')->paginate();

        return view('admin.pages.projetos.index', [
            'projetos' => $projetos            
        ]);
    }

    public function create() 
    {
        return view('admin.pages.projetos.create');
    }

    public function store(StoreUpdateProjetoRequest $request)
    {
        $user = auth()->user();
        //dd($user);
        $data = $request->all();
        $str=str_replace(",",".",$request['orcamento']);
        $data['orcamento'] = $str;
        //dd($data);

        $data['user_id'] = $user->id;
 
        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("projetos/{$user->id}");
        };
       

        $this->repository->create($data);

        return redirect()->route('projetos.index')
            ->with('message', 'Registro cadastrado com sucesso!');
    }

    public function show($url)
    {
        $projeto = $this->repository->where('url', $url)->first();

        if (!$projeto)
            return redirect()->back();

        return view('admin.pages.projetos.show', [
            'projeto' => $projeto
        ]);
    }

    public function delete($url)
    {
        $projeto = $this->repository
                //->with('details')
                ->where('url', $url)
                ->first();

        if (!$projeto)
            return redirect()->back();

            /*
            if ($projeto->details->count()) {
                return redirect()
                        ->back()
                        ->with('error', 'Existem detalhes vinculados ao projeto! Não é possível deletar!');
            }
            */
        if (Storage::exists($projeto->image)) {
            Storage::delete($projeto->image);
        }
    
        $projeto->delete();

        return redirect()->route('projetos.index')
        ->with('message', 'Registro deletado com sucesso!');

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $projetos = $this->repository->search($request->filter);

        return view('admin.pages.projetos.index', [
            'projetos' => $projetos,
            'filters' => $filters,
        ]);
    }


    public function edit($url)
    {
        $projeto = $this->repository->where('url', $url)->first();

        if (!$projeto)
            return redirect()->back();

        return view('admin.pages.projetos.edit', [
            'projeto' => $projeto,
        ]);
    }

    public function update(StoreUpdateProjetoRequest $request, $url)
    {
        $user = auth()->user();
        //dd($user);

        $projeto = $this->repository->where('url', $url)->first();

        if (!$projeto)
            return redirect()->back();

        $data = $request->all();

        $str=str_replace(",",".",$request['orcamento']);
        //dd($str);
        $data['orcamento'] = $str;

        $projeto->update( $data);

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($projeto->image)) {
                Storage::delete($projeto->image);
            }

            $data['image'] = $request->image->store("projetos/{$user->id}");
        };

        $projeto->update($data);

        return redirect()->route('projetos.index')
            ->with('message', 'Registro alterado com sucesso!');
    }

}
