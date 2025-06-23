<?php

use App\Models\Role;
use App\Models\UsersProfiles;
use App\Models\ProfilesRoles;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin() {
        $user = Auth::user();
        //dame TODOS los perfiles del usuario
        $profiles = UsersProfiles::where('user_id', $user->id)->pluck('profile_id')->toArray();

        //recorre el array de profiles y dame todos los roles que tenga cada perfil
        $profileRoles = ProfilesRoles::whereIn('profile_id', $profiles)->pluck('role_id')->toArray();

        //dame los nombres de los roles dentro del array de roles
        $arrayRoles = Role::whereIn('id', $profileRoles)->pluck('name')->toArray();
        
        //valida si en roles existe ROLE_ADMIN
        if (in_array("ROLE_ADMIN", $arrayRoles)) {
            //si existe, continua con la peticion
            return true;
        }
        return false;
    }
}

