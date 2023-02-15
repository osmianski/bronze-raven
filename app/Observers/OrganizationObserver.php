<?php

namespace App\Observers;

use App\Models\Account\Type;
use App\Models\Organization;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        $organization->account()->create(['type' => Type::Organization]);
    }
}
