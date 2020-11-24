<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

use Carbon\Carbon;

class AlertasController extends Controller
{
    public function mostrar_alertas(){
        $evolucionNotifications = auth()->user()->unreadNotifications;
        return view('evoluciones.verevolucion', compact('evolucionNotifications')); 
    }

    public function mostrar_leidas(){
        $evolucionNotifications = auth()->user()->readNotifications;
        return view('evoluciones.verleidas', compact('evolucionNotifications')); 
    }

    public function MarkAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function markOne($id){
        $noti=DatabaseNotification::findOrFail($id);
        $noti->read_at = Carbon::now();
        $noti->save();
        return redirect()->back();
    }
}
