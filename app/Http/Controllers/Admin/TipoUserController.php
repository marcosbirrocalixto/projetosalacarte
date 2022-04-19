<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoUserRequest;
use App\Models\tipouser;
use Illuminate\Http\Request;

class TipoUserController extends Controller
{
    public function __construct(tipouser $tipouser)
    {
        $this->repository = $tipouser;

       // $this->middleware(['can:categorias']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipousers = $this->repository->orderBy('name')->paginate();

        return view('admin.pages.tipousers.index', compact('tipousers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tipousers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatetipouserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoUserRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tipousers.index')
            ->with('message', 'Registro cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tipouser = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.tipousers.show', compact('tipouser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tipouser = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.tipousers.edit', compact('tipouser'));
    }


    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateTipoUserRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatetipouserRequest $request, $id)
    {
        if (!$tipouser = $this->repository->find($id)) {
            return redirect()->back();
        }

        $tipouser->update($request->all());

        return redirect()->route('tipousers.index')
            ->with('message', 'Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tipouser = $this->repository->find($id)) {
            return redirect()->back();
        }

        $tipouser->delete();

        return redirect()->route('tipousers.index');
    }


    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $tipousers = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                                    
                                }
                            })
                            ->orderBy('name')
                            ->paginate();

        return view('admin.pages.tipousers.index', compact('tipousers', 'filters'));
    }
}
