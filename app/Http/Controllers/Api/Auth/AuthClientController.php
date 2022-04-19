<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\loginClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Projeto;
use App\Models\TipoProjeto;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    private $projeto, $user;

    public function __construct(Projeto $projeto, User $user)
    {
        $this->projeto = $projeto;
        $this->user = $user;

        //$this->middleware(['can:detailPlan']);
    }

    public function auth(StoreClientRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        //$projetos = Projeto::where('user_id', 1)->get();
        //return [$projetos];

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'messages.credenciais_invalidas'], 422);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token]);
     }

    public function perfil(Request $request)
    {
        $user = auth()->user();
        $logado = true;

        $data = $request->all();
        //return $data;

        if(isset($data['password'])){
            $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', "unique:users,email,{$user->id},id"],
                'password' => ['required', 'string', 'min:6', 'max:20'],
                'password_confirmation' => 'required_with:password|same:password|min:6',
                'device_name' => ['required'],
            ]);
            if ($validacao->fails()){
                return $validacao->errors();
            }
            $user->password = bcrypt($data['password']);
        }else{
            $valiacao = Validator::make($data, [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id},id"],
            ]);
        }

        if($valiacao->fails()){
            return $valiacao->errors();
          }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->endereco = $data['endereco'];
        $user->numero = $data['numero'];
        $user->bairro = $data['bairro'];
        $user->cidade = $data['cidade'];
        $user->cep = $data['cep'];
        $user->celular = $data['celular'];

        //return $user->name;

        if(isset($data['image'])){
            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg','jpeg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );
                // check file format
                if (!in_array($format, $allow)) {
                    return false;
                }
                // check base64 format
                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }
                return true;
            });

            $validacao = Validator::make($data, [
                'image' => 'base64image',

            ],['base64image'=>'Imagem inválida - Imagens aceitas: png, jpg, svg e jpeg']);

            if($validacao->fails()){
              return $validacao->errors();
            }

            $time = time();
            $diretorioPai = 'perfis';
            $diretorioImagem = 'images/'.$diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;
            $ext = substr($data['image'], 11, strpos($data['image'], ';') - 11);
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;
            //return ($urlImagem);

            $file = str_replace('data:image/'.$ext.';base64,','',$data['image']);
            $file = base64_decode($file);

            if(!file_exists($diretorioPai)){
                mkdir($diretorioPai,0700);
            }
            //Coloca para deletar foto antiga

            if(!file_exists($diretorioImagem)){
            mkdir($diretorioImagem,0700);
            }
            //return ($file);
            file_put_contents($urlImagem,$file);
            //return ($urlImagem);
            //$user->image = asset($user->image);
            $user->image = "http://projetosalacarte.local/".$urlImagem;
            //return ($urlImagem);
        }
        //return $user;

        $user->save();

        if ($user) {
            $user->token = $user->createToken($request->device_name)->plainTextToken;
            return response()->json($user);
        }else{
            return false;
        }
    }

    public function me(Request $request)
    {
        $user = $request->user();

        //return response()->json($user);

        return new ClientResource($user);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke all tokens user...
        $user->tokens()->delete();

        return response()->json([], 204);
    }

    public function getProjetos(Request $request)
    {
        $user = $request->user();
        //$user = $this->user->where('id', $user->id)->first();
        //return $user;

        $projetos = $user->projetos()->get();

        return response()->json($projetos);
    }

    public function getCategorias()
    {
        $categorias = Categoria::all();
        //return $categorias;

        return response()->json($categorias);
    }

    public function getTipoProjetos()
    {
        $tipoProjetos = TipoProjeto::all();
        //return $tipoProjetos;

        return response()->json($tipoProjetos);
    }

    public function cadprojetos(Request $request)
    {
        $logado = false;

        $validacao = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }

        $user = user::where('email', $request->email)->first();
        //$projetos = Projeto::where('user_id', 1)->get();
        //return [$projetos];

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => trans('messages.credenciais_invalidas')], 200);
        }else{
            $logado = true;
        }

        if ($logado) {
            $user->token = $user->createToken($request->device_name)->plainTextToken;

            //Cadastr Projeto



            //return response()->json($user);
        }else{
            return false;
        }
    }

}
