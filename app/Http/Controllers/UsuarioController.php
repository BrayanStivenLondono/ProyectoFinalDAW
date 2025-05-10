<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //

    public function index()
    {
        return view("index");
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
            'contrasena' => 'required|string|min:6|confirmed', // Confirmación de contraseña
            'tipo' => 'required|string|in:artista,visitante', // Tipo puede ser 'artista' o 'visitante'
        ]);

        // Creamos el nuevo usuario
        $usuario = Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena), // Encriptamos la contraseña
            'tipo' => $request->tipo,
            'biografia' => $request->biografia, // Si tienes campo biografía en el formulario
            'enlaces_sociales' => $request->enlaces_sociales, // Si tienes campo de enlaces sociales
            'imagen_perfil' => 'imagenes/user_default.jpg', // Imagen por defecto
            'fecha_registro' => now(),
        ]);

        // Realizamos el login automáticamente (opcional)

        // Redirigimos al usuario al dashboard u otra página
        return redirect("/");
    }

    public function mostrarPerfil()
    {
        $usuario = Auth::user();
        return view('usuario.verPerfil', compact('usuario'));
    }

    public function mostrarEditorPerfil(){
        $usuario = Auth::user();
        return view("usuario.actualizarPerfil", compact("usuario"));
    }

    public function actualizarPerfil(Request $request)
    {
        $validate = $request->validate([
            'nombre_usuario'   => 'required|max:255|unique:usuarios,nombre_usuario,' . auth()->id(),
            'nombre'           => 'required|max:255',
            'apellido'         => 'nullable|max:255',
            'correo'           => 'required|email|unique:usuarios,correo,' . auth()->id(),
            'contrasena'       => 'nullable|min:5',
            'imagen_perfil'      => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $usuario = Auth::user();
        dd($usuario->nombre_usuario);

        $usuario->nombre_usuario = $validate['nombre_usuario'];
        $usuario->nombre = $validate['nombre'];
        $usuario->apellido = $validate['apellido'] ?? '';
        $usuario->correo = $validate['correo'];


        if (!empty($validate['contrasena'])) {
            $usuario->contrasena = Hash::make($validate['contrasena']);
        }

        if ($request->hasFile('ruta_imagen')) {
            $imagen = $request->file('ruta_imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $usuario->ruta_imagen = 'imagenes/' . $nombreImagen;
        }

        $usuario->save();

        return redirect()->route("perfil");
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
}
