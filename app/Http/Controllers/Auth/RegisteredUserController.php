<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\registrationUserRequest;
use App\Providers\RouteServiceProvider;
use App\Tenant\Events\TenantCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisteredUserController extends Controller
{
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
            /*
            'empresa' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,name'],
            'cnpj' => ['required', 'numeric', 'digits:14', 'unique:tenants'],
            */
        ]);
    }

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Pega plano
        //if ( !$plan = session('plan') ) {
        //    return redirect()->route('site.home');
        //}

        /*
        $tenant = $plan->tenants()->create([
            'cnpj'          => $request['cnpj'],
            'name'          => $request['empresa'],
            'email'         => $request['email'],
            'logo'          => 'imagem.jpg',
            'subscription'  => now(),
            'expires_at'    => now()->addDay(7),
        ]);
        */
        //dd ($request->all());

        $user = $this->user->create([
            'tenant_id' => 1,
            'tipouser_id' => 1,
            'name' => $request['name'],
            'email' => $request['email'],
            'code' => substr(strtoupper($request['name']), 0, 4).rand(100,999),
            'uuid' => Str::uuid(),
            'password' => bcrypt($request['password']),
        ]);

        //event(new TenantCreated($user));
        event(new Registered($user)); //Envia e-mail validação e boa vindas

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
