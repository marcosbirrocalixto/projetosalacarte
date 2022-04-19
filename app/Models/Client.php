<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class Client extends Authenticatable 
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'code', 'uuid', 'email_verified_at', 'image'
    ];

    /**
     * Get Projetos
     */
    public function projetos()
    {
        return $this->hasMany(Projeto::class);
    }

}
