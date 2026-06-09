<?php
namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Plato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    public function index()
    {
        return view('favoritos.index');
    }

    public function toggle(Plato $plato)
    {
        // Lo implementamos en Fase 6
        return back();
    }
}