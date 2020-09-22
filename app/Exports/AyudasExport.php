<?php

namespace App\Exports;

use App\Ayuda;
use App\Beneficiario;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class AyudasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	public function __construct($fechaInicio,$fechaFin,$edadInicial,$edadFinal,$barrio_id,$generoBeneficiario)
	{

		$this->fechaInicio=$fechaInicio;
		$this->fechaFin=$fechaFin;
		$this->edadInicial=$edadInicial;
		$this->edadFinal=$edadFinal;
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
            'Ayudas recibidas'



    	];
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


//Filtro todos los campos vacíos o en primera posición

    	if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario=="-1") {
    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();



    		return $ayuda;



    	}
//Filtro con fechas llenas; los demas campos vacíos y en la primera posición
    	if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario=="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;


    	}
//Filtro con fechas llenas; y campos edad llenos, los demás vacíos o  en la primera posición
    	if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario=="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;



    	}
//Filtro con fechas llenas; y campos edad llenos,barrio lleno también  en la primera posición, género en la primera prosición
    	if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario=="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('barrios.id',$this->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;



    	}
//Todos los campos llenos
    	if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario!="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('barrios.id',$this->barrio_id)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;



    	}
//Fechas vacías, edades llenas, barrio todos,Género todos
    	if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario=="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;

    	}
//fechas vacías,edades vacías, barrio lleno,género en todos
    	if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario=="-1") {

    		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',  $this->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

    		return $ayuda;

    	}
//Género lleno, los démas vacíos
if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.GeneroBeneficiario',  $this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;



		}

//Fechas llenas y género lleno. Los démas campos vacíos
		if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;
			}

//Fechas llenas, edades llenas, barrio en todos, género llenos
		if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();


				return $ayuda;

			}
//Género lleno, barrio lleno; los demás vacíos

		if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$this->barrio_id)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;

			}
//Edad lleno, barrio lleno, género  lleno, fechas vacías
		if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('barrios.id',$this->barrio_id)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;
			}

//Fechas vacias, género en todos, barrio lleno, edad lleno
		if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario=="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('barrios.id',$this->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;
			}

//Fechas llenas, edades vacías, barrios llenos, género todos

		if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario=="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('barrios.id',$this->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;



		}
//Fechas llenas, barrios llenos, género lleno, edades vacías
		if (!empty($this->fechaInicio)  &&  !empty($this->fechaFin) && empty($this->edadInicial)  &&  empty($this->edadFinal) && $this->barrio_id!="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $this->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $this->fechaInicio)->where('barrios.id',$this->barrio_id)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

				return $ayuda;
			}
//Fechas vacías,edad llenas, barrios en todos, género lleno
		if (empty($this->fechaInicio)  &&  empty($this->fechaFin) && !empty($this->edadInicial)  &&  !empty($this->edadFinal) && $this->barrio_id=="-1" && $this->generoBeneficiario!="-1") {

				$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $this->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $this->edadInicial)->where('beneficiarios.GeneroBeneficiario',$this->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();


				return $ayuda;

			}



    }//Método

}
