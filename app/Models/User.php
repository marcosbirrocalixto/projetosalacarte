<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\UserACLTrait;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserACLTrait, Billable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id', 'tipouser_id', 'name', 'email', 'image', 'code', 'endereco', 'numero', 'bairro', 'cidade', 'cep', 'celular', 'uuid', 'device_name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get Projetos
     */
    public function projetos()
    {
        return $this->hasMany(Projeto::class);
    }

    /**
     * Roles not linked with this user
     */
    public function rolesAvailable($filter = null)
    {
        $roles = Role::whereNotIn('roles.id', function($query) {
            $query->select('role_user.role_id');
            $query->from('role_user');
            $query->whereRaw("role_user.user_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $roles;
    }

    public function plan()
    {
        $stripePlan = $this->subscription('default')->stripe_plan;

        return Plan::where('stripe_id', $stripePlan)->first();
    }

    public function tipousers()
    {
        return $this->belongsTo(TipoUser::class);
    }
}
