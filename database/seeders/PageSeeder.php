<?php

namespace Database\Seeders;

use App\Http\Controllers\PageController;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::create([
            'title' => 'Home',
            'body' => 'Welcome to the `bronze-raven` project!',
        ]);
        Slug::create([
            'slug' => '/',
            'controller_class' => PageController::class,
            'page_id' => $page->id,
        ]);
    }
}
