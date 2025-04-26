<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function index()
    {
        //logica para el index de obra
    }

    public function obtenerObrasCarrusel()
    {
        $obras = Obra::latest()->take(8)->get();
        return view("index", compact("obras"));

    }


}
