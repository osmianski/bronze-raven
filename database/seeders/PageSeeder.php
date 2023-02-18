<?php

namespace Database\Seeders;

use App\Http\Controllers\PageController;
use App\Models\Organization;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        /* @var Organization $admin */
        $admin = Organization::with('account')
            ->where('is_admin', '=', true)
            ->firstOrFail();

        $page = Page::create([
            'owner_id' => $admin->account->id,
            'title' => 'Home',
            'body' => file_get_contents(__DIR__ . '/home.md'),
        ]);
        Slug::create([
            'slug' => '',
            'type' => Slug\Type::Page,
            'page_id' => $page->id,
        ]);

        $page = Page::create([
            'owner_id' => $admin->account->id,
            'title' => 'Usage',
            'body' => file_get_contents(__DIR__ . '/usage.md'),
        ]);
        Slug::create([
            'slug' => 'usage',
            'type' => Slug\Type::Page,
            'page_id' => $page->id,
        ]);
    }
}
