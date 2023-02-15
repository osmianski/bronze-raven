<?php

namespace App\Observers;

use App\Models\Account\Type;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->account()->create(['type' => Type::User]);
    }
}
