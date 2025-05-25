<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    //

    public function index(Request $request)
    {
        if (!auth()->user() || auth()->user()->tipo !== 'administrador') {
            return redirect("/");
        }

        $busqueda = $request->input('busqueda');
        $tipo = $request->input('tipo');

        $usuarios = Usuario::when($busqueda, function ($query, $busqueda) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'like', "%$busqueda%")
                    ->orWhere('apellido', 'like', "%$busqueda%")
                    ->orWhere('nombre_usuario', 'like', "%$busqueda%");
            });
        })
            ->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })
            ->get();

        return view('usuario.index', compact('usuarios'));
    }


    public function darLike(Obra $obra)
    {
        $usuario = auth()->user(); // Obtener al usuario autenticado

        // Verificar si el usuario ya dio like a la obra
        if ($usuario->likes()->where('id_obra', $obra->id)->exists()) {
            // Si ya ha dado like, lo eliminamos (deshacer el like)
            $usuario->likes()->detach($obra->id);
            return response()->json(['message' => 'Like eliminado']);
        }

        // Si no ha dado like, lo agregamos
        $usuario->likes()->attach($obra->id);
        return response()->json(['message' => 'Like agregado']);
    }


    public function mostrarRegistro()
    {
        return view("usuario.registro");
    }

    public function registrar(Request $request)
    {
        // Validamos los datos recibidos del formulario
        $request->validate([
            'nombre_usuario' => 'required|string|max:255|unique:usuarios',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:usuarios',
            'contrasena' => 'required|string|min:6|confirmed',
            'tipo' => 'required|string|in:artista,visitante',
        ]);

        // Creamos el nuevo usuario
        $usuario = Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'tipo' => $request->tipo,
            'biografia' => $request->biografia,
            'enlaces_sociales' => $request->enlaces_sociales,
            'imagen_perfil' => 'imagenes/user_default.jpg',
            'fecha_registro' => now(),
        ]);

        // 🔐 Login automático
        Auth::login($usuario);

        // Redirigimos al usuario
        return redirect("/");
    }

    public function verPerfilPublico($slug)
    {
        $usuario = Usuario::all()->first(function ($u) use ($slug) {
            return Str::slug($u->nombre . ' ' . $u->apellido) === $slug;
        });

        if (!$usuario) {
            abort(404);
        }

        return view('usuario.perfilPublico', compact('usuario'));
    }

    public function panelConfiguracion()
    {
        return view("layouts.configuration");
    }

    public function mostrarPerfil($slug)
    {
        $nombre = str_replace('-', ' ', $slug);
        $usuario = Usuario::whereRaw("CONCAT(nombre, ' ', apellido) = ?", [$nombre])->firstOrFail();

        return view('usuario.verPerfil', compact('usuario'));
    }

    public function mostrarEditorPerfil(){
        $usuario = Auth::user();
        return view("usuario.actualizarPerfil", compact("usuario"));
    }

    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $validate = $request->validate([
            'nombre_usuario' => [
                'required',
                'max:255',
                Rule::unique('usuarios')->ignore($usuario->id),
            ],
            'nombre' => 'required|max:255',
            'apellido' => 'nullable|max:255',
            'correo' => [
                'required',
                'email',
                Rule::unique('usuarios')->ignore($usuario->id),
            ],
            'imagen_perfil' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $usuario->nombre_usuario = $validate['nombre_usuario'];
        $usuario->nombre = $validate['nombre'];
        $usuario->apellido = $validate['apellido'] ?? '';
        $usuario->correo = $validate['correo'];


        if ($request->hasFile('imagen_perfil')) {
            $imagen = $request->file('imagen_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $usuario->imagen_perfil = 'imagenes/' . $nombreImagen;
        }

        $usuario->save();

        return redirect()->route("mostrarEditorPerfil");
    }

    public function formCambiarContrasena()
    {
        return view('usuario.cambioContrasena');
    }

    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'password_actual' => ['required'],
            'nueva_password' => ['required', 'min:6', 'confirmed'],
        ]);

        $usuario = Auth::user();

        if (!Hash::check($request->password_actual, $usuario->contrasena)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta']);
        }

        $usuario->contrasena = Hash::make($request->nueva_password);
        $usuario->save();

        return redirect()->route('configuracion')->with('success', 'La contraseña se cambió correctamente.');
    }

    public function mostrarPanelBaja()
    {
        return view("usuario.eliminarCuenta");
    }

    public function mostrarFormularioConfirmacion()
    {
        return view("usuario.confirmarContrasena");
    }

    public function eliminarCuenta(Request $request)
    {
        $usuario = Auth::user();

        Auth::logout();
        $usuario->delete();

        return redirect('/')->with('success', 'Tu cuenta fue eliminada correctamente.');
    }

    public function mostrarPanelPrivacidad(){
        return view("usuario.privacidad");
    }



    public function mostrarLogin()
    {
        return view("usuario.login");
    }
    public function login(Request $request)
    {
        {
            $request->validate([
                'nombre_usuario' => 'required',
                'contrasena' => 'required',
            ]);

            $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

            if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
                Auth::login($usuario);
                return redirect("/");
            }

            return back();
        }
    }

    public function mostrarConfiguracionUsuario()
    {
        return view("usuario.configuracionUsuario");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function verPerfilArtista($slug)
    {
        $nombre = str_replace('-', ' ', $slug);

        $artista = Usuario::whereRaw("LOWER(CONCAT(nombre, ' ', apellido)) = ?", [strtolower($nombre)])
            ->where('tipo', 'artista')
            ->with('obras')
            ->firstOrFail();

        return view('usuario.verPerfilArtista', compact('artista'));
    }

    public function artistas(Request $request)
    {
        $query = Usuario::where('tipo', 'artista');

        if ($request->filled('nombre')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre . '%')
                    ->orWhere('apellido', 'like', '%' . $request->nombre . '%');
            });
        }

        // Obtener artistas con paginación
        $artistas = $query->paginate(8); // Puedes ajustar la cantidad por página

        // Lista completa sin filtro (si la necesitas para otro propósito)
        $artistas2 = Usuario::where('tipo', 'artista')->get();

        return view('usuario.artistas', compact('artistas', 'artistas2'));
    }


    public function mostrarPanelArtista()
    {
        $usuario = Auth::user();

        if ($usuario->tipo !== 'artista') {
            abort(403);
        }

        $obras = $usuario->obras;

        // Aquí es clave: asegúrate de pasar la variable con el nombre que usas en la vista
        return view('usuario.panelArtista', [
            'artista' => $usuario,
            'obras' => $obras
        ]);
    }

    public function hacerAdmin($id)
    {
        if (!auth()->user() || auth()->user()->tipo !== 'administrador') {
            return redirect()->url('/');
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->tipo = 'administrador';
        $usuario->save();

        return redirect()->route('panel_usuarios');
    }

    public function mostrarPanelAdministracion(){
        return view("usuario.admin");
    }

    public function admin()
    {
        $usuario = auth()->user();

        if (!auth()->user() || auth()->user()->tipo !== 'administrador') {
            return redirect("/");
        }

        return view('usuario.admin', compact('usuario'));

    }
    public function eliminarUsuario($id)
    {
        $usuarios = Usuario::findOrFail($id);
        $usuarios->delete();

        return redirect()->route("panel_usuarios");
    }

}
