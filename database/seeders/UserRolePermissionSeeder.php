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
        $roleAuthor = Role::create(['name' => 'author']);

        // create permissions news
        $permissionNews = Permission::create(['name' => 'news']);
        $permissionNewsCreate = Permission::create(['name' => 'news.create']);
        $permissionNewsEdit = Permission::create(['name' => 'news.edit']);
        $permissionNewsDelete = Permission::create(['name' => 'news.delete']);

        // create permissions comment
        $permissionComment = Permission::create(['name' => 'comment']);
        $permissionCommentCreate = Permission::create(['name' => 'comment.create']);
        $permissionCommentEdit = Permission::create(['name' => 'comment.edit']);
        $permissionCommentDelete = Permission::create(['name' => 'comment.delete']);

        // assign permissions to roles

        // admin to news
        $roleAdmin->givePermissionTo($permissionNews);
        $roleAdmin->givePermissionTo($permissionNewsCreate);
        $roleAdmin->givePermissionTo($permissionNewsEdit);
        $roleAdmin->givePermissionTo($permissionNewsDelete);

        //admin to comment
        $roleAdmin->givePermissionTo($permissionComment);
        $roleAdmin->givePermissionTo($permissionCommentCreate);
        $roleAdmin->givePermissionTo($permissionCommentEdit);
        $roleAdmin->givePermissionTo($permissionCommentDelete);

        // author to news
        $roleAuthor->givePermissionTo($permissionNews);
        $roleAuthor->givePermissionTo($permissionNewsCreate);
        $roleAuthor->givePermissionTo($permissionNewsEdit);
        $roleAuthor->givePermissionTo($permissionNewsDelete);

        // user to news
        $roleUser->givePermissionTo($permissionNews);

        // user to comment
        $roleUser->givePermissionTo($permissionComment);
        $roleUser->givePermissionTo($permissionCommentCreate);
        $roleUser->givePermissionTo($permissionCommentEdit);
        $roleUser->givePermissionTo($permissionCommentDelete);


        // create admin
        $admin = User::factory()->create(
            [
                'name' => 'Dicky',
                'email' => 'dicky@gmail.com',
                'password' => Hash::make('password'),
            ],
        );

        //create author
        $author = User::factory()->create(
            [
                'name' => 'Adit',
                'email' => 'adit@gmail.com',
                'password' => Hash::make('password'),
            ],
        );

        // create user
        $user = User::factory()->create(
            [
                'name' => 'Arif',
                'email' => 'arif@gmail.com',
                'password' => Hash::make('password'),
            ],
        );

        // assign roles to users
        $user->assignRole($roleUser);
        $admin->assignRole($roleAdmin);
        $author->assignRole($roleAuthor);

        //assign permission to user
        $author->givePermissionTo($permissionComment);
    }
}
