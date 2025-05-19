<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Database\Seeders\ObraSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObraController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user() || auth()->user()->tipo !== 'administrador') {
            return redirect("/");
        }

        $busqueda = $request->input('busqueda');

        $obras = Obra::when($busqueda, function ($query, $busqueda) {
            $query->where('titulo', 'like', "%$busqueda%")
                ->orWhere('autor', 'like', "%$busqueda%")
                ->orWhere('anio', 'like', "%$busqueda%")
                ->orWhere('estilo', 'like', "%$busqueda%");
        })->get();

        return view('obra.index', compact('obras'));
    }

    public function mostrarTodasObras(){
        return view("obra.verObras");
    }

    public function verObras(Request $request)
    {
        $query = Obra::query();

        // Búsqueda por título
        if ($request->filled('busqueda')) {
            $query->where('titulo', 'like', '%' . $request->busqueda . '%');
        }

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $tiposObra = Obra::select('tipo')->distinct()->pluck('tipo');

        // Aquí usamos la query con filtros
        $obras = $query->latest()->paginate(8);

        return view('obra.verObras', compact('obras', 'tiposObra'));
    }


    public function carresulColecciones()
    {
        $obrasPorTipo = Obra::select('obras.*')
            ->join(DB::raw('(SELECT MIN(id) as id FROM obras GROUP BY tipo) as sub'), 'obras.id', '=', 'sub.id')
            ->whereNotNull('obras.tipo') // Filtra los registros donde tipo no es nulo
            ->where('obras.tipo', '!=', '') // Filtra los registros donde tipo no esté vacío
            ->get();


        $obras = Obra::latest()->take(5)->get();

        return view('index', compact('obrasPorTipo', 'obras'));
    }

    public function obtenerObrasPorTipo(string $tipo)
    {
        $obrasPorTipo = Obra::where('tipo', $tipo)->latest()->paginate(5);
        return view('obra.verColeccion', compact('obrasPorTipo', 'tipo'));
    }


    public function verTodasLasColecciones()
    {
        $obrasPorTipo = Obra::select('obras.*', DB::raw('(SELECT COUNT(*) FROM obras as o2 WHERE o2.tipo = obras.tipo) as total'))
            ->join(DB::raw('(SELECT MIN(id) as id FROM obras GROUP BY tipo) as sub'), 'obras.id', '=', 'sub.id')
            ->whereNotNull('obras.tipo')
            ->where('obras.tipo', '!=', '')
            ->orderBy('tipo')
            ->paginate(4); // Especifica el número de elementos por página (ej: 10)

        return view('obra.colecciones', compact('obrasPorTipo'));
    }

    public function verObra($titulo)
    {
        // Convertir el nombre de la obra en un slug
        $tituloSlug = str_replace('-', ' ', $titulo);

        // Buscar la obra por título (sin importar mayúsculas o minúsculas)
        $obra = Obra::whereRaw('LOWER(titulo) = ?', [strtolower($tituloSlug)])->first();

        if (!$obra) {
            abort(404);
        }

        return view('obra.verObra', compact('obra'));
    }

    public function eliminarObra($id)
    {

        $obra = Obra::find($id);

        if (!$obra) {
            return redirect();
        }

        if (auth()->user()->tipo !== 'administrador') {
            return redirect("/");
        }

        $obra->delete();

        return redirect("/admin/obras");
    }

    public function editarObra($id)
    {
        $obra = Obra::findOrFail($id); // Busca la obra por ID o lanza 404

        return view('obra.editorObra', compact('obra'));
    }

    public function actualizarObra(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'string',
            'año_creacion' => 'integer',  // Validación para año
        ]);

        $obra = Obra::findOrFail($id);
        $obra->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'año_creacion' => $request->año_creacion,
        ]);
        // Actualiza otros campos si es necesario

        $obra->save();

        return redirect("/panel-artista");
    }
}
