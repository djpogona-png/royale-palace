<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use App\Models\Mesa;
use App\Models\Plato;
use App\Models\User;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sedeId = $user->sede_id;

        $query = $sedeId
            ? Reservacion::where('sede_id', $sedeId)
            : Reservacion::query();

        $reservacionesHoy    = (clone $query)->whereDate('fecha', today())->whereIn('estado', ['pendiente','confirmada'])->count();
        $reservacionesMes    = (clone $query)->whereMonth('fecha', now()->month)->count();
        $mesasOcupadas       = $sedeId ? Mesa::where('sede_id', $sedeId)->where('activa', true)->count() : Mesa::where('activa', true)->count();
        $platosDisponibles   = $sedeId ? Plato::where('sede_id', $sedeId)->where('disponible', true)->count() : Plato::where('disponible', true)->count();
        $clientesRegistrados = User::role('web')->count(); // usuarios sin rol admin
        $ultimasReservaciones = (clone $query)->with(['user','mesa','sede'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'reservacionesHoy', 'reservacionesMes',
            'mesasOcupadas', 'platosDisponibles',
            'clientesRegistrados', 'ultimasReservaciones'
        ));
    }
}