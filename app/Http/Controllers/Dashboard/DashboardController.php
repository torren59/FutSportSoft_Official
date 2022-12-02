<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Devuelve una pareja de valores unix que representan fechas
     * @param date fechaInicial ['Y-m']
     * @param date fechaFinal ['Y-m']
     * 
     */
    private function getIntervals($fechaInicial, $fechaFinal){
        //El array guardará el intervalo final
        $intervalo = [];
        $periodo = [];
        $meses = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octobre' ,
        11 => 'Noviembre', 12 => 'Diciembre'];

        // Inicializando formato fecha [string]
        $nodo[0] = $fechaInicial.'-28';
        $nodo[1] = $fechaFinal.'-28';

        // Traduciendo a formato UNIX
        $nodo[0] = strtotime($nodo[0]); 
        $nodo[1] = strtotime($nodo[1]); 

        // Determinando último día del mes para los extremos dados
        $i = 0;
        foreach($nodo as $point){
            $fecha = $point;
            $newFecha = 0;
            do{
                $newFecha = strtotime(date('Y-m-d',$fecha)."+1 day");

                if(date('m',$fecha) == date('m',$newFecha)){
                    $fecha = $newFecha;
                }
                else{
                    $intervalo[$i] = $fecha;
                }

            }while(date('m',$fecha) == date('m',$newFecha));
            $i += 1;
        }

        // Determina días finales y nombre para cada mes en el intervalo
        $mes = $intervalo[0];
        $newMes = 0;

        while( date('Y-m-d',$mes) <= date('Y-m-d',$intervalo[1]) ){
            // Insersión de datos directamente anteriores
            $registro = ['fecha' => date('Y-m-d',$mes), 'mes' => $meses[date('n',$mes)]];
            array_push($periodo, $registro);

            //Calculando fecha del próximo mes
            $mes = strtotime(date('Y-m-d',$mes).'+28 day');
            do{
                $newMes = strtotime(date('Y-m-d',$mes)."+1 day");
                if(date('m',$mes) == date('m',$newMes)){
                    $mes = $newMes;
                }
            }while(date('m',$mes) == date('m',$newMes));

        }

        return $periodo;
    }

    public function index($FechaInicial = null, $FechaFinal = null){
        
        $meses = [];
        $fechas = [];
        $valores = [];

        $intervalo = $this->getIntervals('2022-1','2022-12');
        // return date('Y-m-d',$intervalo[0]);
        // $B = date('Y-m-d',$intervalo[0]);
        // $c = strtotime($B.'+1 month');
        return $intervalo;


        // return view('Dashboard.dashboard');
    }
}
