<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;
    

    public function __construct(Plan $plan) 
    {
        $this->repository = $plan;

        //$this->middleware(['can:plan']);
    }

    public function index() 
    {
        $plans = $this->repository->orderBy('price')->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans            
        ]);
    }

    public function create() 
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlanRequest $request)
    {
        //dd($request->all());
        $str=str_replace(",",".",$request['price']);
        //dd($str);
        $data = $request->all();
        $data['price'] = $str;
        //dd($data);
        $this->repository->create($data);

        return redirect()->route('plans.index')
            ->with('message', 'Registro cadastrado com sucesso!');
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    public function delete($url)
    {
        $plan = $this->repository
                ->with('details')
                ->where('url', $url)
                ->first();

        if (!$plan)
            return redirect()->back();

            if ($plan->details->count()) {
                return redirect()
                        ->back()
                        ->with('error', 'Existem detalhes vinculados ao plano! Não é possível deletar!');
            }
    
        $plan->delete();

        return redirect()->route('plans.index')
        ->with('message', 'Registro deletado com sucesso!');

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }


    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan,
        ]);
    }

    public function update(StoreUpdatePlanRequest $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $str=str_replace(",",".",$request['price']);
        //dd($str);
        $data = $request->all();
        $data['price'] = $str;

        $plan->update( $data);

        return redirect()->route('plans.index')
            ->with('message', 'Registro alterado com sucesso!');
    }

}
