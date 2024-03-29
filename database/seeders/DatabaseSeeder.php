<?php

namespace Database\Seeders;

use App\Models\ClientCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@1234')
        ])->assignRole(Role::create(['name' => config('super.super-admin')]));
        Permission::create(['name' => 'pode-acessar-area-admin']);

        ClientCategory::create(['name' => 'Professor']);
        ClientCategory::create(['name' => 'Aluno']);
    }
}
