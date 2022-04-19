<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'cnpj', 'name', 'url', 'email', 'logo', 'active',
                           'subscription', 'expires_at', 'subscription_id',
                           'subscription_active', 'subscription_suspended'];

    public function users()
    {
        return $this->hasMany(User::class); // Um tenant pode ter vários usuários (1:N)
    }
    

    public function plan()
    {
        return $this->belongsTo(Plan::class); // retorna qual o plano que o tenant está cadastrado
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('email', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }
}
