<?php

namespace App\Exports;
use App\Ayuda;
use App\Beneficiario;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class SinAyudaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	public function __construct($barrio_id,$generoBeneficiario)
	{
       $this->barrio_id = $barrio_id;
       $this->generoBeneficiario=$generoBeneficiario;

   }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
    	return [
    		'Documento',
    		'Nombre',
    		'Apellido',
    		'Edad',
    		'Dirección',
    		'Barrio',
    		'Teléfono',
    		'Género',
            'Código'];
        }
        public function registerEvents(): array
        {
           return [
              AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function collection()
    {
//Todos los campos en la primera posición
        if ($this->barrio_id=="-1" && $this->generoBeneficiario=="-1") {

            $beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->select('beneficiarios.DocumentoBeneficiario','beneficiarios.NombreBeneficiario','beneficiarios.ApellidoBeneficiario','beneficiarios.EdadBeneficiario','beneficiarios.DireccionBeneficiario','barrios.NombreBarrio','beneficiarios.TelefonoBeneficiario',
                'beneficiarios.GeneroBeneficiario',
                'beneficiarios.id')->get();
            $cantidadFemenino=0;
            $cantidadMasculino=0;
            $cantidadGeneroOtro=0;
            $cantidadBeneficiario=0;

            $beneficiarios = collect();
            foreach ($beneficiario as  $value) {

                $countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();

                if ($countAyudaBeneficiario==0) {

                    $subQuery=$beneficiario->where('id',$value->id);
                    $beneficiarios = $beneficiarios->concat($subQuery);
                    if ($value->GeneroBeneficiario=="Femenino") {
                        $cantidadFemenino++;
                    }
                    elseif ($value->GeneroBeneficiario=="Masculino") {
                        $cantidadMasculino++;
                    }
                    else{
                        $cantidadGeneroOtro++;
                    }
                    $cantidadBeneficiario++;
                }}
                return $beneficiarios;
            }
//Barrio lleno y género en todos
            if ($this->barrio_id!="-1" && $this->generoBeneficiario=="-1") {

                $beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$this->barrio_id)->select('beneficiarios.DocumentoBeneficiario','beneficiarios.NombreBeneficiario','beneficiarios.ApellidoBeneficiario','beneficiarios.EdadBeneficiario','beneficiarios.DireccionBeneficiario','barrios.NombreBarrio','beneficiarios.TelefonoBeneficiario',
                    'beneficiarios.GeneroBeneficiario',
                    'beneficiarios.id')->get();
                $cantidadFemenino=0;
                $cantidadMasculino=0;
                $cantidadGeneroOtro=0;
                $cantidadBeneficiario=0;

                $beneficiarios = collect();
                foreach ($beneficiario as  $value) {
                    $countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
                    if ($countAyudaBeneficiario==0) {

                        $subQuery=$beneficiario->where('id',$value->id);
                        $beneficiarios = $beneficiarios->concat($subQuery);
                        if ($value->GeneroBeneficiario=="Femenino") {
                            $cantidadFemenino++;
                        }
                        elseif ($value->GeneroBeneficiario=="Masculino") {
                            $cantidadMasculino++;
                        }
                        else{
                            $cantidadGeneroOtro++;
                        }
                        $cantidadBeneficiario++;
                    }

                }
                return $beneficiarios;



            }
//Género lleno y barrio en todos
            if ($this->barrio_id=="-1" && $this->generoBeneficiario!="-1") {

                $beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->select('beneficiarios.DocumentoBeneficiario','beneficiarios.NombreBeneficiario','beneficiarios.ApellidoBeneficiario','beneficiarios.EdadBeneficiario','beneficiarios.DireccionBeneficiario','barrios.NombreBarrio','beneficiarios.TelefonoBeneficiario',
                    'beneficiarios.GeneroBeneficiario',
                    'beneficiarios.id')->get();
                $cantidadFemenino=0;
                $cantidadMasculino=0;
                $cantidadGeneroOtro=0;
                $cantidadBeneficiario=0;

                $beneficiarios = collect();
                foreach ($beneficiario as  $value) {
                    $countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
                    if ($countAyudaBeneficiario==0) {

                        $subQuery=$beneficiario->where('id',$value->id);
                        $beneficiarios = $beneficiarios->concat($subQuery);
                        if ($value->GeneroBeneficiario=="Femenino") {
                            $cantidadFemenino++;
                        }
                        elseif ($value->GeneroBeneficiario=="Masculino") {
                            $cantidadMasculino++;
                        }
                        else{
                            $cantidadGeneroOtro++;
                        }
                        $cantidadBeneficiario++;
                    }

                }
                return $beneficiarios;

            }
//Barrio lleno y género llenos
            if ($this->barrio_id!="-1" && $this->generoBeneficiario!="-1") {

                $beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$this->barrio_id)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->select('beneficiarios.DocumentoBeneficiario','beneficiarios.NombreBeneficiario','beneficiarios.ApellidoBeneficiario','beneficiarios.EdadBeneficiario','beneficiarios.DireccionBeneficiario','barrios.NombreBarrio','beneficiarios.TelefonoBeneficiario',
                    'beneficiarios.GeneroBeneficiario',
                    'beneficiarios.id')->get();
                $cantidadFemenino=0;
                $cantidadMasculino=0;
                $cantidadGeneroOtro=0;
                $cantidadBeneficiario=0;

                $beneficiarios = collect();
                foreach ($beneficiario as  $value) {
                    $countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
                    if ($countAyudaBeneficiario==0) {

                        $subQuery=$beneficiario->where('id',$value->id);
                        $beneficiarios = $beneficiarios->concat($subQuery);
                        if ($value->GeneroBeneficiario=="Femenino") {
                            $cantidadFemenino++;
                        }
                        elseif ($value->GeneroBeneficiario=="Masculino") {
                            $cantidadMasculino++;
                        }
                        else{
                            $cantidadGeneroOtro++;
                        }
                        $cantidadBeneficiario++;
                    }

                }
                return $beneficiarios;

            }



            }//Método

        }



