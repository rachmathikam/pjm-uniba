<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = User::create([
            'name'  => 'petugas pjm',
            'email'     => 'petugas_pjm@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);

        $role           = Role::where('name', 'petugas_pjm')->first();
        $user->assignRole([$role->id]);
    }
}

