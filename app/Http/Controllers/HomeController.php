<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $config= App\Models\Config::findOrFail(1);
        $camas=App\Models\Cama::all();
        $totalG=$totalPC=$totalUTI=$totalH=$totalD=0;
        $libresG=$libresPC=$libresUTI=$libresH=$libresD=0;
        $ocupadasG=$ocupadasPC=$ocupadasUTI=$ocupadasH=$ocupadasD=0;
        $array = array();

        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == '1') {
                $totalG++;
                if ($cama->paciente_id == NULL) {
                    $libresG++;
                }
                else {
                    $ocupadasG++;
                }
            }
            elseif ($cama->sala->sistema->id == '2') {
                $totalPC++;
                if ($cama->paciente_id == NULL) {
                    $libresPC++;
                }
                else {
                    $ocupadasPC++;
                }
            }
            elseif ($cama->sala->sistema->id == '3') {
                $totalUTI++;
                if ($cama->paciente_id == NULL) {
                    $libresUTI++;
                }
                else {
                    $ocupadasUTI++;
                }
            }
            elseif ($cama->sala->sistema->id == '4') {
                $totalD++;
                if ($cama->paciente_id == NULL) {
                    $libresD++;
                }
                else {
                    $ocupadasD++;
                }
            }
            else {
                $totalH++;
                if ($cama->paciente_id == NULL) {
                    $libresH++;
                }
                else {
                    $ocupadasH++;
                }
            }
        }

        array_push($array, $totalG);array_push($array, $libresG);array_push($array, $ocupadasG);
        array_push($array, $totalPC);array_push($array, $libresPC);array_push($array, $ocupadasPC);
        array_push($array, $totalUTI);array_push($array, $libresUTI);array_push($array, $ocupadasUTI);
        array_push($array, $totalD);array_push($array, $libresD);array_push($array, $ocupadasD);
        array_push($array, $totalH);array_push($array, $libresH);array_push($array, $ocupadasH);

        return view('home',compact ('config','array'));
    }

    public function redir()
    {
        if (auth()->check()) {
            return redirect('home');
        }
        else {
            return redirect('login');
        }
    }
}