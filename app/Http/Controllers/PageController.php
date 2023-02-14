<?php

namespace App\Http\Controllers;

use App\Exceptions\NotImplemented;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PageController extends Controller
{
    public function show(Slug $slug): Response|ResponseFactory
    {
        return inertia('Page', [
            'page' => Page::whereSlugId($slug->id)->firstOrFail(),
        ]);
    }

    public function update(Request $request)
    {
        Page::where('id', '=', $request->query('id'))
            ->update((array)$request->post());
    }
}
