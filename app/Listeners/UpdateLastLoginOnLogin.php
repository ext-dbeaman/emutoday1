<?php

namespace emutoday\Listeners;

use emutoday\User;

use Carbon\Carbon;

class UpdateLastLoginOnLogin
{

    public function handle(User $user, $remember)
    {
        $user->last_login_at = Carbon::now();
        $user->save();
    }
}
