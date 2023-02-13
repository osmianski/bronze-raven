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
        $slug = Slug::create([
            'slug' => '/',
            'controller_class' => PageController::class,
        ]);
        Page::create([
            'slug_id' => $slug->id,
            'title' => 'Home',
            'body' => file_get_contents(__DIR__ . '/home.md'),
        ]);
    }
}
