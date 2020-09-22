<?php

namespace App\Imports;

use App\Barrio;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBarrio implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //dd($row["0"]);
        return new Barrio([
            'NombreBarrio'=> $row["0"],
            'EstadoBarrio'=> $row["1"], 
        ]);
    }
}
