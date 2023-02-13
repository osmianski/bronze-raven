<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Slug;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PageController extends Controller
{
    public function __invoke(Slug $slug): Response|ResponseFactory
    {
        return inertia('Page', [
            'page' => Page::whereSlugId($slug->id)->firstOrFail(),
        ]);
    }
}
