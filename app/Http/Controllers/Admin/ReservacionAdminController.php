<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use App\Models\Sede;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionAdminController extends Controller
{
    public function index(Request $request)
    {
        $user   = Auth::user();
        $query  = Reservacion::with(['user', 'sede', 'mesa']);

        // Admins de sede solo ven su sede
        if ($user->sede_id) {
            $query->where('sede_id', $user->sede_id);
        }

        // Filtros
        if ($request->fecha)   $query->where('fecha', $request->fecha);
        if ($request->estado)  $query->where('estado', $request->estado);
        if ($request->sede_id) $query->where('sede_id', $request->sede_id);

        $reservaciones = $query->orderBy('fecha', 'desc')
                               ->orderBy('hora', 'desc')
                               ->paginate(20);

        return view('admin.reservaciones.index', compact('reservaciones'));
    }

    public function cambiarEstado(Request $request, Reservacion $reservacion)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada'
        ]);

        $reservacion->update(['estado' => $request->estado]);

        return back()->with('success', "Reservación {$reservacion->codigo} actualizada a: {$request->estado}");
    }

    public function reporte(Request $request)
    {
        $user  = Auth::user();
        $mes   = $request->mes ?? now()->month;
        $anio  = $request->anio ?? now()->year;

        $query = Reservacion::with(['user', 'sede', 'mesa'])
            ->whereMonth('fecha', $mes)
            ->whereYear('fecha', $anio);

        if ($user->sede_id) {
            $query->where('sede_id', $user->sede_id);
        }

        $reservaciones = $query->orderBy('fecha')->get();

        $sede = $user->sede ?? null;

        $pdf = Pdf::loadView('admin.reportes.reservaciones', compact(
            'reservaciones', 'mes', 'anio', 'sede'
        ))->setPaper('a4', 'landscape');

        return $pdf->download("reporte-reservaciones-{$mes}-{$anio}.pdf");
    }
}