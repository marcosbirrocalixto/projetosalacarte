<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Str;

class ClientRepository implements ClientRepositoryInterface
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function createNewClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $data['name']);
        $data['code'] = substr(strtoupper($nome), 0, 3).rand(100,999);
        $data['uuid'] = Str::uuid();

        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {

    }

}