<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions()//: array //Retorna as permissões nos dois níveos (Cargos e planos) 
    {
        /*
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $permission) {
            if (in_array($permission, $permissionsPlan))
                array_push($permissions, $permission);
        }

        return $permissions;    
        */    
    }   

    public function permissionsPlan()//: array //Retorna permissões do plano assinado
    {
        /*
        ///$tenant = $this->tenant()->first();
        //$plan = $tenant->plan;
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        } 
        
        return $permissions;
        */
    }

    public function permissionsRole()//: //array  //retorna permissões do cargo
    {
        /*
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
        */
    }


    // Aqui verifico se usuario tem a permissão tpara acessar o recurso.
    public function hasPermission(string $permissionName)//: bool
    {
        //return in_array($permissionName, $this->permissions());
    }

    //Verifica se usuário é admin
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    //Verifica se usuário não é admin
    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}