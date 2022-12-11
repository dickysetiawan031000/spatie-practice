<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        // create permissions
        $permissionNews = Permission::create(['name' => 'news']);
        $permissionNewsCreate = Permission::create(['name' => 'news.create']);
        $permissionNewsEdit = Permission::create(['name' => 'news.edit']);
        $permissionNewsDelete = Permission::create(['name' => 'news.delete']);

        // assign permissions to roles
        $roleAdmin->givePermissionTo($permissionNews);
        $roleAdmin->givePermissionTo($permissionNewsCreate);
        $roleAdmin->givePermissionTo($permissionNewsEdit);
        $roleAdmin->givePermissionTo($permissionNewsDelete);

        $roleUser->givePermissionTo($permissionNews);

        // create user
        $user = User::factory()->create(
            [
                'name' => 'Dicky',
                'email' => 'user@news.com',
                'password' => Hash::make('password'),
            ],
        );

        // create admin
        $admin = User::factory()->create(
            [
                'name' => 'Adit',
                'email' => 'admin@news.com',
                'password' => Hash::make('password'),
            ],
        );

        // assign roles to users
        $user->assignRole($roleUser);
        $admin->assignRole($roleAdmin);
    }
}
