<?php

namespace App\Observers;

use App\Models\Projeto;
use Illuminate\Support\Str;

class ProjetoObserver
{
    /**
     * Handle the Projeto "created" event.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return void
     */
    public function creating(Projeto $projeto)
    {
        $projeto->tenant_id = auth()->user()->tenant_id;
        $projeto->user_id = auth()->user()->id;
        $projeto->url = Str::kebab($projeto->name);
    }

    /**
     * Handle the Projeto "updated" event.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return void
     */
    public function updating(Projeto $projeto)
    {
        $projeto->url = Str::kebab($projeto->name);
    }

    /**
     * Handle the Projeto "deleted" event.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return void
     */
    public function deleted(Projeto $projeto)
    {
        //
    }

    /**
     * Handle the Projeto "restored" event.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return void
     */
    public function restored(Projeto $projeto)
    {
        //
    }

    /**
     * Handle the Projeto "force deleted" event.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return void
     */
    public function forceDeleted(Projeto $projeto)
    {
        //
    }
}
