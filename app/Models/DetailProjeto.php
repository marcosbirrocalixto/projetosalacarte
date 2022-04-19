<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProjeto extends Model
{
    use HasFactory;

    protected $table = 'details_projeto';

    protected $fillable = ['projeto_id', 'name', 'description', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6'];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class); //Retorna apenas um projeto
    }
}
