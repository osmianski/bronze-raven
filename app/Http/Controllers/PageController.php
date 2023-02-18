<?php

namespace App\Http\Controllers;

use App\Exceptions\NotImplemented;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PageController extends Controller implements Sluggable
{
    public function show(Slug $slug): Response|ResponseFactory
    {
        return inertia('Page', [
            'page' => Page::where('id', '=', $slug->page_id)->firstOrFail(),
        ]);
    }

    public function update(Request $request)
    {
        Page::where('id', '=', $request->query('id'))
            ->each(function (Page $page) use ($request) {
                $page->update((array)$request->post());
            });
    }
}
