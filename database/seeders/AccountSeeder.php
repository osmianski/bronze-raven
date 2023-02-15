<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::create([
            'name' => 'Administrators',
            'is_admin' => true,
        ]);

        $organization->users()->create([
            'name' => 'Administrator',
            'email' => 'admin@osmianski.com',
            'password' => bcrypt('secret'),
        ]);


    }
}
