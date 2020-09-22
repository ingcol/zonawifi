<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'NombreUsuario'           => 'usuario',
            'ApellidoUsuario'         => '22222',
            'DocumentoUsuario'        => '22222',
            'email'                   => 'dannergomez385@gmail.com',
            'username'                => 'danner',
            'email_verified_at'       => null,
            'EstadoUsuario'           => 'Activo',
            'TelefonoUsuario'          =>'3124672655',
            'password'       => '$2y$10$b/ii.dSiSSQ46/A0o2MfPOVdFsGqndz.27zcAfZk4Bm8MX6Qzb4A2',
            'GeneroUsuario'  => 'Masculino',
            'remember_token' => null,
            'created_at'     => '2019-03-04 06:24:27',
            'updated_at'     => '2019-03-04 06:24:27',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
