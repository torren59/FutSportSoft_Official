<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Devuelve una pareja de valores unix que representan fechas
     * @param date fechaInicial ['Y-m']
     * @param date fechaFinal ['Y-m']
     * 
     */
    private function getIntervals($fechaInicial, $fechaFinal)
    {
        //El array guardará el intervalo final
        $intervalo = [];
        $periodo = [];
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octobre',
            11 => 'Noviembre', 12 => 'Diciembre'
        ];

        // Inicializando formato fecha [string]
        $nodo[0] = $fechaInicial . '-28';
        $nodo[1] = $fechaFinal . '-28';

        // Traduciendo a formato UNIX
        $nodo[0] = strtotime($nodo[0]);
        $nodo[1] = strtotime($nodo[1]);

        // Determinando último día del mes para los extremos dados
        $i = 0;
        foreach ($nodo as $point) {
            $fecha = $point;
            $newFecha = 0;
            do {
                $newFecha = strtotime(date('Y-m-d', $fecha) . "+1 day");

                if (date('m', $fecha) == date('m', $newFecha)) {
                    $fecha = $newFecha;
                } else {
                    $intervalo[$i] = $fecha;
                }
            } while (date('m', $fecha) == date('m', $newFecha));
            $i += 1;
        }

        // Determina días finales y nombre para cada mes en el intervalo
        $mes = $intervalo[0];
        $newMes = 0;

        while (date('Y-m-d', $mes) <= date('Y-m-d', $intervalo[1])) {
            // Insersión de datos directamente anteriores
            $registro = ['fecha' => date('Y-m-d', $mes), 'mes' => $meses[date('n', $mes)]];
            array_push($periodo, $registro);

            //Calculando fecha del próximo mes
            $mes = strtotime(date('Y-m-d', $mes) . '+28 day');
            do {
                $newMes = strtotime(date('Y-m-d', $mes) . "+1 day");
                if (date('m', $mes) == date('m', $newMes)) {
                    $mes = $newMes;
                }
            } while (date('m', $mes) == date('m', $newMes));
        }

        return $periodo;
    }
    /*
    public function index(Request $request){
        $intervalos = [];
        $dash1 = [];
        $meses = [];
        $inscritos = [];

        // Determinando periodo para consulta
        if(!isset($request->InitialYear)){
            // $year = date('Y');
            // $intervalos = $this->getIntervals($year.'-1', date('Y-m')); NO BORRAR
            $intervalos = $this->getIntervals('1969-12', '1970-12');
        }
        else{
            $initialDate = $request->initialYear.'-'.$request->initialMonth;
            $finalDate = $request->finalYear.'-'.$request->finalMonth;

            $intervalos = $this->getIntervals($initialDate, $finalDate);
        }

        //Consultando estadística y almacenando resultados --Todo queda guardado en la variable dash1
        foreach($intervalos as $intervalo){
            array_push($meses,$intervalo['mes']);

            $inscritoMes = DB::table('grupos_deportistas')
            ->distinct(['grupos_deportistas.Documento'])
            ->join('grupos','grupos_deportistas.GrupoId','=','grupos.GrupoId')
            ->join('programacion','grupos.GrupoId','=','programacion.GrupoId')
            ->where('grupos_deportistas.Estado','=',true)
            ->where('programacion.FechaFinalizacion','>=',$intervalo['fecha'])
            ->count();

            array_push($inscritos,$inscritoMes);
        }

        $dash1 = ['inscritos' => $inscritos, 'meses' => $meses]; 

        return view('Dashboard.dashboard')->with('dash1',$dash1);
    }
    */

    public function index()
    {
        $ofertedMonths = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $firstYear = date('Y', strtotime(Programacion::min('FechaInicio')));
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentMonthName = $ofertedMonths[$currentMonth - 1];

        $ofertedYears = [];
        $year = $firstYear;
        while ($year <= $currentYear) {
            array_push($ofertedYears, intval($year));
            $year += 1;
        }

        return view('Dashboard.dashboard')->with('ofertedYears', $ofertedYears)->with('ofertedMonths', $ofertedMonths)
            ->with('currentYear', $currentYear)->with('currentMonth', $currentMonth)->with('currentMonthName', $currentMonthName);
    }

    public function useFirstInterval(Request $request)
    {
        $meses = [];
        $inscritos = [];

        $year = date('Y');
        //$intervalos = $this->getIntervals($year.'-1', date('Y-m')); NO BORRAR
        $intervalos = $this->getIntervals('1970-1', '1970-12');


        //Consultando estadística y almacenando resultados --Todo queda guardado en la variable dash1
        foreach ($intervalos as $intervalo) {
            array_push($meses, $intervalo['mes']);

            $inscritoMes = DB::table('grupos_deportistas')
                ->distinct(['grupos_deportistas.Documento'])
                ->join('grupos', 'grupos_deportistas.GrupoId', '=', 'grupos.GrupoId')
                ->join('programacion', 'grupos.GrupoId', '=', 'programacion.GrupoId')
                ->where('grupos_deportistas.Estado', '=', true)
                ->where('programacion.FechaFinalizacion', '>=', $intervalo['fecha'])
                ->count();

            array_push($inscritos, $inscritoMes);
        }

        $dash1 = ['inscritos' => $inscritos, 'meses' => $meses];

        return json_encode($dash1);
    }

    public function useNewInterval(Request $request)
    {
        $meses = [];
        $inscritos = [];
        $inferiorYear = json_decode($request->inferiorYear);
        $inferiorMonth = json_decode($request->inferiorMonth);
        $guion = '-';
        $inferiorDate = $inferiorYear.$guion.$inferiorMonth;
        $fragA = substr($inferiorDate,1,4);
        $fragB = 0;
        if(strlen($inferiorDate) > 8){
            $fragB = substr($inferiorDate,6,3);
        }
        else{
            $fragB = substr($inferiorDate,6,2);
        }
        $fragC = $fragA.$fragB;

        $superiorYear = json_decode($request->superiorYear);
        $superiorMonth = json_decode($request->superiorMonth);
        $superiorDate = $superiorYear.$guion.$superiorMonth;
        $fragA2 = substr($superiorDate,1,4);
        $fragB2 = 0;
        if(strlen($superiorDate) > 8){
            $fragB2 = substr($superiorDate,6,3);
        }
        else{
            $fragB2 = substr($superiorDate,6,2);
        }
        $fragC2 = $fragA2.$fragB2;

        $intervalos = $this->getIntervals($fragC, $fragC2);

        //Consultando estadística y almacenando resultados --Todo queda guardado en la variable dash1
        foreach ($intervalos as $intervalo) {
            array_push($meses, $intervalo['mes']);

            $inscritoMes = DB::table('grupos_deportistas')
                ->distinct(['grupos_deportistas.Documento'])
                ->join('grupos', 'grupos_deportistas.GrupoId', '=', 'grupos.GrupoId')
                ->join('programacion', 'grupos.GrupoId', '=', 'programacion.GrupoId')
                ->where('grupos_deportistas.Estado', '=', true)
                ->where('programacion.FechaFinalizacion', '>=', $intervalo['fecha'])
                ->count();

            array_push($inscritos, $inscritoMes);
        }

        $dash1 = ['inscritos' => $inscritos, 'meses' => $meses];
        $A = ['infDate' => $inferiorDate];

        return json_encode($dash1);
    }
}
