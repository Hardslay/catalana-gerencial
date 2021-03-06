<?php

namespace App\Http\Controllers\ISO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Help\Help;
use App\Models\Container;
use App\Models\SubContainer;
use App\Models\Archive;
use App\Models\ArchiveType;
use App\Models\History;
use App\Exports\ISO\ISOR1_Export;
use App\Exports\ISO\ISOR2_Export;

class ISOController extends Controller
{
  public function __construct(){
    set_time_limit(8000000);
    ini_set('memory_limit', '1G');

    $this->middleware('auth');
  }

  public function home(){
    $help = new Help();
    $containers = Container::all();
    $types = ArchiveType::all();
    activity('Visita')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' visitó /iso/home.');
    return view ('iso.home',compact('help','containers','types'));
  }


    public function r1_($format, $container){
        if(Auth::user()->hasPermissionTo('iso_tactical')){
          $contenedores = array();
          $titulo = "reporte-general-procesos-".Help::dateYear();
          if($container!='0'){
            $contenedores = Container::where('id',$container)->get();
            $titulo = "reporte-general-proceso-". Help::replace_char($contenedores[0]->titulo)."-".Help::dateYear();
          }else{
            $contenedores = Container::all();
          }
          activity('Generación de reporte táctico')
          ->by(Auth::user())
          ->log('El usuario '.Auth::user()->name.' generó el reporte de procesos generados y documento activo del módulo ISO.');

          if($format =='pdf'){
            $pdf = \PDF::loadView('pdf-reports.iso.r1', compact('contenedores','titulo'));
            return $pdf->setPaper('a4', 'landscape')->stream($titulo."-.pdf"  );
          }else{

            return \Excel::download(new ISOR1_Export($contenedores),$titulo.'.xlsx');
          }
      }
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de procesos generados y documento activo del módulo ISO.');
        abort(403,__('Unauthorized'));
      }
    }

   public function r2_($format, $type){
      if(Auth::user()->hasPermissionTo('iso_tactical')){
        $tipos = array();
        $titulo = "reporte-por-tipo-documentos-".Help::dateYear();
        if ($type!='0') {
                $tipos = ArchiveType::where('id',$type)->get();
                $titulo = "reporte-por-tipo-documento-". Help::replace_char($tipos[0]->titulo)."-".Help::dateYear();
        }else{
              $tipos = ArchiveType::all();
        }
        activity('Generación de reporte táctico')
          ->by(Auth::user())
          ->log('El usuario '.Auth::user()->name.' generó el reporte de tipos y sus procesos generados del módulo ISO.');

        if ($format=='pdf') {
          $pdf = \PDF::loadView('pdf-reports.iso.r2', compact('tipos','titulo'));
          return $pdf->setPaper('a4', 'landscape')->stream($titulo . "-.pdf"  );
        }else{
          return \Excel::download(new ISOR2_Export($tipos),$titulo.'.xlsx');
        }
      }
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de procesos generados y documento activo del módulo ISO.');
        abort(403,__('Unauthorized'));
      }
   }

}
