<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPlan extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table = 'details_plan';

    protected $fillable = ['name'];

    public function plan()
    {
        return $this->belongsTo(Plan::class); //Retorna apenas um plano
    }
}
