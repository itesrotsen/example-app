<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $allCreate = Permission::create(['name' => 'create.*']);
        $allEdit = Permission::create(['name' => 'edit.*']);
        $allDelete = Permission::create(['name' => 'delete.*']);
        $allView = Permission::create(['name' => 'view.*']);

        $viewGuess = Permission::create(['name' => 'contact.view']);


        $roleAdmin = Role::create(['name' => 'ADMIN']);
        $roleGuess = Role::create(['name' => 'GUESS']);
        $roleNormal = Role::create(['name' => 'NORMAL']);

        $roleAdmin->givePermissionTo($allCreate);
        $roleAdmin->givePermissionTo($allEdit);
        $roleAdmin->givePermissionTo($allDelete);
        $roleAdmin->givePermissionTo($allView);
        $allEdit->assignRole($roleAdmin);
        $allDelete->assignRole($roleAdmin);
        $allView->assignRole($roleAdmin);
        $allCreate->assignRole($roleAdmin);

        $roleGuess->givePermissionTo($viewGuess);
        $viewGuess->assignRole($roleGuess);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@system',
        ]);
        $user->assignRole($roleAdmin);

        $userGuess = User::factory()->create([
            'name' => 'Guess',
            'email' => 'guess@system',
        ]);

        $userGuess->assignRole($roleGuess);


    }
}
