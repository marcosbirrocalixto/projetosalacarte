<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'tipouser_id'  => 1,
            'name'          => 'Marcos Birro Calixto',
            'uuid'          => Str::uuid(),
            'code'          => strtoupper(substr('Marcos Birro Calixto', 0, 3)).rand (1, 9999),
            'email'         => 'marcosbirrocalixto@outlook.com.br',
            'password'      => bcrypt('gaba1746')        
        ]);   
    }
}
