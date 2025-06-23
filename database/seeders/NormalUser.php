<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfilesRoles;
use App\Models\User;
use App\Models\UsersProfiles;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;

class NormalUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'usuario1@gmail.com',
            'password' => Hash::make('123123'), // Contraseña encriptada
        ]);

        Worker::create([
            'name' => 'Normal User',
            'phone' => '10102002',
            'address' => 'San Salvador, San Salvador',
            'user_id' => $user->id, // Conectar el trabajador con el usuario
        ]);

        $profile = Profile::create([
            'name' => 'Profesor',
            'description' => 'Perfil de profesor con acceso limitado al sistema.',
        ]);

        UsersProfiles::create([
            'created_by' => $user->id,
            'user_id' => $user->id,
            'profile_id' => $profile->id,
        ]);

        $role = Role::create([
            'name' => 'ROLE_PROFESSOR',
            'description' => 'Rol de profesor con permisos limitados.',
        ]);

        ProfilesRoles::create([
            'profile_id' => $profile->id,
            'role_id' => $role->id,
        ]);
    }
}
