<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class PolicyController extends Controller
{
     public function getpolicy(){
        $id=auth()->id();
        $User=User::find($id);
        $Role=$User->roles;
        foreach ($Role as $key => $value) {
            $value->id;
        }
        $Rol=Role::find($value->id);
        $Permisos=$Rol->permissions;
        return $Permisos;

    }
}
