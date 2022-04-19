<?php

namespace App\Observers;

use App\Models\Tipouser;
use Illuminate\Support\Str;

class TipouserObserver
{
    /**
     * Handle the Tenant "created" event.
     *
     * @param  \App\Models\Tipouser  $tenant
     * @return void
     */
    public function creating(Tipouser $tipouser)
    {
        $tipouser->url = Str::kebab($tipouser->name);
    }

    /**
     * Handle the Tenant "updated" event.
     *
     * @param  \App\Models\Tipouser  $tenant
     * @return void
     */
    public function updating(Tipouser $tipouser)
    {
        $tipouser->url = Str::kebab($tipouser->name);
    }
}
