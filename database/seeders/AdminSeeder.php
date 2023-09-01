<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'  => 'admin pjm',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin12345'),
        ]);

        $role           = Role::where('name', 'admin_pjm')->first();
        $permissions    = Permission::pluck('id','id')->all();

        $role->givePermissionTo([$permissions]);
        $user->assignRole([$role->id]);
    }
}
