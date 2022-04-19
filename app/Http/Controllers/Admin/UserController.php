<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUpdateUserRequest;
use App\Models\Tipouser;
use App\Models\User;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $repository;
    

    public function __construct(User $user, Tipouser $tipouser) 
    {
        $this->repository = $user;
        $this->tipouser = $tipouser;

        //$this->middleware(['can:user']);
    }

    public function index() 
    {
        //$users = $this->repository->orderBy('name')->tenantUser()->paginate();

        
        $users = $this->repository->orderBy('name')->tenantUser()->paginate();
        //dd($users);

        return view('admin.pages.users.index', [
            'users' => $users          
        ]);
    }

    public function create() 
    {
        $tipousers = $this->tipouser->paginate();
        return view('admin.pages.users.create', [
            'tipousers' => $tipousers           
        ]);
    }

    public function store(storeUpdateUserRequest $request)
    {
        $data = $request->all();        
        $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $request->name);
        //dd($nome);
        $data['code'] = substr(strtoupper($nome), 0, 4).rand(100,999);
        $data['uuid'] = Str::uuid();

        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); // encrypt password

        //dd($data);

        $this->repository->create($data);

        return redirect()->route('users.index')
            ->with('message', 'Registro cadastrado com sucesso!');
    }

    public function show($id)
    {
        $user = $this->repository->tenantUser()->where('id', $id)->first();

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.show', [
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = $this->repository->tenantUser()
               // ->with('details')
                ->where('id', $id)
                ->first();

        if (!$user)
            return redirect()->back();

            /*
            if ($user->details->count()) {
                return redirect()
                        ->back()
                        ->with('error', 'Existem detalhes vinculados ao plano! Não é possível deletar!');
            }
            */
    
        $user->delete();

        return redirect()->route('users.index')
        ->with('message', 'Registro deletado com sucesso!');

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->repository
            ->where(function($query) use ($request) {
                if ($request->filter) {
                    $query->where('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('email', 'LIKE', "%{$request->filter}%");
                }
            })
            ->orderBy('name')
            ->tenantUser()
            ->paginate();

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters,
        ]);
    }


    public function edit($id)
    {
        $user = $this->repository->tenantUser()->where('id', $id)->first();
        $tipousers = $this->tipouser::get();
        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.edit', [
            'user'      => $user,
            'tipousers'  => $tipousers
        ]);
    }

    public function update(storeUpdateUserRequest $request, $id)
    {
        $user = $this->repository->tenantUser()->where('id', $id)->first();

        if (!$user)
            return redirect()->back();

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);   
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('message', 'Registro alterado com sucesso!');
    }
}
