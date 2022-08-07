<?php

namespace App\Listeners;

use App\Events\CreatedClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatedClientEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreatedClient  $event
     * @return void
     */
    public function handle(CreatedClient $event)
    {
        $permissions = Permission::where('type', 'client')
            ->orWhere('type', 'both')
            ->pluck('name')
            ->toArray();

        $event->client->user->givePermissionTo($permissions);
    }
}
