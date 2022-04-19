<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Plan $plan)
    {
        //return 'Entrou no site de planos';
        $plans = $plan::with('details')->orderBy('price', 'ASC')->get();
        //dd($plans);

        //return view('site.pages.home.index', compact('plans'));

        return view('home.index', compact('plans'));
    }

    public function plan($url)
    {
        if (!$plan = Plan::where('url', $url)->first()) {
            return redirect()->back();
        }

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}
