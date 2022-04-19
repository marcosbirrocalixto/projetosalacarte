<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    private $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

        //$this->middleware(['can:detailPlan']);
    }

    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        };

        //$details = $plan->details();
        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan'      => $plan,
            'details'   => $details,
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.create', [
            'plan'      => $plan,
        ]);
    }

    public function store(StoreUpdateDetailPlanRequest $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        };

        //$data = $request->all();
        //$data['plan_id'] = $plan->id;
        //$this->repository->create($data);

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', [
            'url' => $plan->url,
        ])
        ->with('message', 'Registro inserido com sucesso!');
    }

    public function edit($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.edit', [
            'plan'      => $plan,
            'detail'    => $detail,
        ]);
    }

    public function update(StoreUpdateDetailPlanRequest $request, $urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        };

        $detail->update($request->all());

        return redirect()->route('details.plan.index', [
            'url'      => $plan->url,
        ])
        ->with('message', 'Registro alterado com sucesso!');
    }

    public function show($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.show', [
            'plan'      => $plan,
            'detail'    => $detail,
        ]);
    }

    public function delete($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        };

        $detail->delete();

        return redirect()->route('details.plan.index', [
            'url'      => $plan->url,
        ])
        ->with('message', 'Registro deletado (SoftDelete) com sucesso!');
    }
}
