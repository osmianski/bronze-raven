<?php

namespace App\Http\Controllers;

use App\Models\Slug;
use Inertia\Response;
use Inertia\ResponseFactory;

interface Sluggable
{
    /**
     * Renders an Inertia page for the specified slug.
     *
     * @param Slug $slug
     * @return Response|ResponseFactory
     */
    public function show(Slug $slug): Response|ResponseFactory;
}
