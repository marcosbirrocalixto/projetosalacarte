<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj'      => '33.234.878/0001-90',
            'name'      => 'Projetos a La Carte',
            'email'     => 'marcos.birro@araujoabreu.com.br',
            'logo'      => 'imagem.jpg',
        ]);
    }
}
