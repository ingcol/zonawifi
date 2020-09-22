<?php
use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $empresa = [[
            'id'                      => 1,
            'NombreEmpresa'           => 'Empresa',
            'SloganEmpresa'           => 'Somos los mejores',
            'TelefonoEmpresa'         => '3214723912',
            'DireccionEmpresa'        => 'Calle 21 #11-31',
            'EmailEmpresa'            => 'empresa@gmail.com',


        ]];

        Empresa::insert($empresa);
    }
}
