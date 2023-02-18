<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidSlugController;
use App\Models\Slug;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SlugController extends Controller
{
    public function home(): Response|ResponseFactory
    {
        return $this->show(Slug::whereSlug('')->first());
    }

    public function show(Slug $slug): Response|ResponseFactory
    {
        $controller = app($slug->type->getControllerClass());

        if (!($controller instanceof Sluggable)) {
            throw new InvalidSlugController(__("The ':class' class that is mentioned in the 'slugs' table should implement the ':interface' interface"), [
                'class' => $slug->type->getControllerClass(),
                'interface' => Sluggable::class,
            ]);
        }

        return $controller->show($slug);
    }
}
