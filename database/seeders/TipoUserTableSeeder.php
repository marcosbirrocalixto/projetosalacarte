<?php

namespace Database\Seeders;

use App\Models\TipoUser;
use Illuminate\Database\Seeder;

class TipoUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUser::create([
            'name'  => 'Pessoa Física',
            'url' => 'pessoa-fisica',
            'description' => 'Pessoa Física',
        ]);
    }
}
