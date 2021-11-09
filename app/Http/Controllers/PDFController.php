<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use App\Models\Firmaproyecto;
use App\Models\Tramite;
use App\Models\Expediente;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\App;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{

    // function to display preview
    public function albanco()
    {
        $id= session('idProy');
        $tramite = Tramite::where('idProy',$id)->get();
        foreach ($tramite as $date){
            $fecha= $date->consultaAgenteFinan;
        }
        if ($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes = $meses[(Carbon::parse($fecha)->format('n')) - 1];
        $fechaFormat = Carbon::parse($fecha)->format('d') . ' de ' . $mes . ' de ' . Carbon::parse($fecha)->format('Y');
        }

        $notas = Firmaproyecto::where('proyecto_idProy',$id)
        ->join('tramites','proyecto_idProy','=','tramites.idProy')
        ->join('firmas','firma_idFirma','idFirma')
        ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
        ->join('expedientes','proyecto_idProy','=','expedientes.idProy')
        ->select('cuit','razonSocial', 'montoTotal', 'ciudad', 'operatoriaPrograma',
         'consultaAgenteFinan','sucursalVentanilla','departamento','nombreProyecto')
        ->get();

        return view('notas.albanco', compact('notas','fechaFormat'));
    }

    public function generatePDF()
    {

        $id= session('idProy');
        $tramite = Tramite::where('idProy',$id)->get();
        foreach ($tramite as $date){
            $fecha= $date->consultaAgenteFinan;
        }
        if ($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes = $meses[(Carbon::parse($fecha)->format('n')) - 1];
        $fechaFormat = Carbon::parse($fecha)->format('d') . ' de ' . $mes . ' de ' . Carbon::parse($fecha)->format('Y');
        }

        $notas = Firmaproyecto::where('proyecto_idProy',$id)
        ->join('tramites','proyecto_idProy','=','tramites.idProy')
        ->join('firmas','firma_idFirma','idFirma')
        ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
        ->join('expedientes','proyecto_idProy','=','expedientes.idProy')
        ->select('cuit','razonSocial', 'montoTotal', 'ciudad', 'operatoriaPrograma',
         'consultaAgenteFinan','sucursalVentanilla','departamento','nombreProyecto')
        ->get();

        set_time_limit(600);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('notas.albanco',compact('notas','fechaFormat'));
            return $pdf->stream('pdfview.pdf');
    }
}
