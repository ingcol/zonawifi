<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [[
            'id'         => '1',
            'title'      => 'Sección de configuración',
            'created_at' => '2019-03-04 06:27:23',
            'updated_at' => '2019-03-04 06:27:23',
        ],
            [
                'id'         => '2',
                'title'      => 'Ver datos de la empresa',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '3',
                'title'      => 'Actualizar datos de la empresa',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '4',
                'title'      => 'Ver roles',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '5',
                'title'      => 'Registrar roles',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '6',
                'title'      => 'Actualizar roles',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '7',
                'title'      => 'Ver usuarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '8',
                'title'      => 'Registrar usuarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '9',
                'title'      => 'Actualizar usuarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '10',
                'title'      => 'Sección de registro',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],

            [
                'id'         => '11',
                'title'      => 'Sección de informes',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '12',
                'title'      => 'Informe general',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '13',
                'title'      => 'Ver barrios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '14',
                'title'      => 'Registrar barrios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '15',
                'title'      => 'Actualizar barrios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '16',
                'title'      => 'Ver beneficiarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '17',
                'title'      => 'Registrar beneficiarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '18',
                'title'      => 'Actualizar beneficiarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '19',
                'title'      => 'Eliminar beneficiarios',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '20',
                'title'      => 'Ver ayudas',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '21',
                'title'      => 'Registrar ayudas',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '22',
                'title'      => 'Actualizar ayudas',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '23',
                'title'      => 'Eliminar ayudas',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '24',
                'title'      => 'Ver infome m¨²ltiple',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            [
                'id'         => '25',
                'title'      => 'Exportar infome m¨²ltiple',
                'created_at' => '2019-03-04 06:27:23',
                'updated_at' => '2019-03-04 06:27:23',
            ],
            ];

        Permission::insert($permissions);
    }
}
