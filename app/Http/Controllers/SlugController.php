<?php

namespace App\Http\Controllers;

use App\Models\Slug;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SlugController extends Controller
{
    public function home(): Response|ResponseFactory
    {
        return $this->show(Slug::whereSlug('/')->first());
    }

    public function show(Slug $slug): Response|ResponseFactory
    {
        return app($slug->controller_class)->show($slug);
    }
}
