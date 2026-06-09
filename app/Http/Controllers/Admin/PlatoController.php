<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plato;
use App\Models\Sede;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatoController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $query = Plato::with(['sede', 'categoria']);

        if ($user->sede_id) {
            $query->where('sede_id', $user->sede_id);
        }

        $platos = $query->orderBy('sede_id')->orderBy('categoria_id')->paginate(20);
        return view('admin.platos.index', compact('platos'));
    }

    public function create()
    {
        $sedes     = Sede::where('activa', true)->get();
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.platos.create', compact('sedes', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'sede_id'     => 'required|exists:sedes,id',
            'categoria_id'=> 'required|exists:categorias,id',
        ]);

        Plato::create($request->only([
            'nombre','descripcion','precio','sede_id','categoria_id',
            'disponible','es_insignia','es_temporada'
        ]));

        return redirect()->route('admin.platos.index')
            ->with('success', 'Platillo creado correctamente.');
    }

    public function edit(Plato $plato)
    {
        $sedes      = Sede::where('activa', true)->get();
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.platos.edit', compact('plato', 'sedes', 'categorias'));
    }

    public function update(Request $request, Plato $plato)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'sede_id'     => 'required|exists:sedes,id',
            'categoria_id'=> 'required|exists:categorias,id',
        ]);

        $plato->update($request->only([
            'nombre','descripcion','precio','sede_id','categoria_id',
            'disponible','es_insignia','es_temporada'
        ]));

        return redirect()->route('admin.platos.index')
            ->with('success', 'Platillo actualizado correctamente.');
    }

    public function destroy(Plato $plato)
    {
        $plato->delete();
        return back()->with('success', 'Platillo eliminado.');
    }
}