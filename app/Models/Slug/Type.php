<?php

namespace App\Models\Slug;

use App\Exceptions\NotImplemented;
use App\Http\Controllers\PageController;

enum Type: string
{
    case Page = 'page';

    public function getControllerClass(): string {
        return match ($this) {
            self::Page => PageController::class,
            default => throw new NotImplemented(),
        };
    }
}
