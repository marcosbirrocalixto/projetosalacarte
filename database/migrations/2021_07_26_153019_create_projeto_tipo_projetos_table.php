<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetoTipoProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeto_tipo_projeto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_projeto_id');
            $table->unsignedBigInteger('projeto_id');

            $table->foreign('tipo_projeto_id')
                        ->references('id')
                        ->on('tipo_projetos')
                        ->onDelete('cascade');

            $table->foreign('projeto_id')
                        ->references('id')
                        ->on('projetos')
                        ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projeto_tipo_projeto');
    }
}
