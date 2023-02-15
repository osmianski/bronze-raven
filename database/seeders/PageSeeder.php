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

        $slug = Slug::create([
            'slug' => '/',
            'controller_class' => PageController::class,
        ]);
        Page::create([
            'slug_id' => $slug->id,
            'owner_id' => $admin->account->id,
            'title' => 'Home',
            'body' => file_get_contents(__DIR__ . '/home.md'),
        ]);
    }
}
