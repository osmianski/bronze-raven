<?php

namespace App\Models\Account;

enum Type: string
{
    case User = 'user';
    case Organization = 'organization';
}
