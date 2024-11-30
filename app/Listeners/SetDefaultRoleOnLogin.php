<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetDefaultRoleOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // Check if the user does not already have a role or needs updating
        if ($user->role_id !== 2) {
            $user->role_id = 2; // Set the role ID to 2
            $user->save();     // Save the changes
        }
    }
}
