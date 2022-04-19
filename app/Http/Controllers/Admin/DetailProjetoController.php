<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailProjetoRequest;
use App\Models\DetailProjeto;
use App\Models\Projeto;
use Illuminate\Http\Request;

class DetailProjetoController extends Controller
{
    private $repository, $projeto;

    public function __construct(DetailProjeto $detailProjeto, Projeto $projeto)
    {
        $this->repository = $detailProjeto;
        $this->projeto = $projeto;

        //$this->middleware(['can:detailProjeto']);
    }

    public function index($idProjeto)
    {
        if (!$projeto = $this->projeto->where('id', $idProjeto)->first()) {
            return redirect()->back();
        };
        //dd($projeto);

        //$details = $projeto->details();
        $details = $projeto->details()->paginate();
        //dd($details);

        return view('admin.pages.projetos.details.index', [
            'projeto'      => $projeto,
            'details'   => $details,
        ]);
    }

    public function create($idProjeto)
    {
        if (!$projeto = $this->projeto->where('id', $idProjeto)->first()) {
            return redirect()->back();
        };

        //dd($projeto);

        return view('admin.pages.projetos.details.create', [
            'projeto'      => $projeto,
        ]);
    }

    public function store(StoreUpdateDetailProjetoRequest $request, $idProjeto)
    {
        $user = auth()->user();
        $data = $request->all();
        $images = $request->images;
        //dd($urlProjeto);
        if (!$projeto = $this->projeto->where('id', $idProjeto)->first()) {
            return redirect()->back();
        };

        //dd($projeto);


        /*
        No backend só muda que você tem um array de imagens:
        */
        //dd($images);
        if ($images != '') {
        $i = 0;
        foreach ($request->images as $image) {
        
        $name = uniqid(date('HisYmd'));
    
        // Recupera a extensão do arquivo
        $extension = $image->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload, arquivo por arquivo
        $upload = $image->storeAs("projetos/{$user->id}", "detail_projetos/{$user->id}/$nameFile");
        $i = $i + 1;

        if ( $i == 1 ) {
            $data['image1'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 2 ) {
            $data['image2'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 3 ) {
            $data['image3'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 4 ) {
            $data['image4'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 5 ) {
            $data['image5'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 6 ) {
            $data['image6'] = "detail_projetos/{$user->id}/$nameFile";
        }

        }
        }

        //dd($data);

        $projeto->details()->create($data);

        return redirect()->route('details.projeto.index', [
            'id' => $projeto->id,
        ])
        ->with('message', 'Registro inserido com sucesso!');
    }

    public function edit($urlProjeto, $idDetail)
    {
        $projeto   = $this->projeto->where('url', $urlProjeto)->first();
        $detail = $this->repository->find($idDetail);

        if (!$projeto || !$detail) {
            return redirect()->back();
        };

        return view('admin.pages.projetos.details.edit', [
            'projeto'      => $projeto,
            'detail'    => $detail,
        ]);
    }

    public function update(StoreUpdateDetailProjetoRequest $request, $urlProjeto, $idDetail)
    {
        $user = auth()->user();
        $data = $request->all();
        $projeto   = $this->projeto->where('url', $urlProjeto)->first();
        $detail = $this->repository->find($idDetail);

        $i = 0;
        foreach ($request->images as $image) {
        
        $name = uniqid(date('HisYmd'));
    
        // Recupera a extensão do arquivo
        $extension = $image->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload, arquivo por arquivo
        $upload = $image->storeAs("projetos/{$user->id}", "detail_projetos/{$user->id}/$nameFile");
        $i = $i + 1;

        if ( $i == 1 ) {
            $data['image1'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 2 ) {
            $data['image2'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 3 ) {
            $data['image3'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 4 ) {
            $data['image4'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 5 ) {
            $data['image5'] = "detail_projetos/{$user->id}/$nameFile";
        }
        if ( $i == 6 ) {
            $data['image6'] = "detail_projetos/{$user->id}/$nameFile";
        }

        }

        if (!$projeto || !$detail) {
            return redirect()->back();
        };
        //dd($detail);
        $detail->update($data);

        return redirect()->route('details.projeto.index', [
            'id'      => $projeto->id,
        ])
        ->with('message', 'Registro alterado com sucesso!');
    }

    public function show($urlProjeto, $idDetail)
    {
        $projeto   = $this->projeto->where('url', $urlProjeto)->first();
        $detail = $this->repository->find($idDetail);

        if (!$projeto || !$detail) {
            return redirect()->back();
        };

        return view('admin.pages.projetos.details.show', [
            'projeto'      => $projeto,
            'detail'    => $detail,
        ]);
    }

    public function delete($urlProjeto, $idDetail)
    {
        $projeto   = $this->projeto->where('url', $urlProjeto)->first();
        $detail = $this->repository->find($idDetail);

        if (!$projeto || !$detail) {
            return redirect()->back();
        };

        $detail->delete();

        return redirect()->route('details.projeto.index', [
            'url'      => $projeto->url,
        ])
        ->with('message', 'Registro deletado (SoftDelete) com sucesso!');
    }
}
