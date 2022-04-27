<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    // Devolver la vista con todas las canciones
    public function index()
    {
        $songs = Song::get();

        return view("inicio")
            ->with("songs", $songs);
    }
    

    public function agregarCancion(Request $peticion)
    {

        # Crear un modelo...
        $song = new Song;

        # Establecer propiedades leídas del formulario
        $song->nombre = $peticion->nombre;
        $song->artista = $peticion->artista;
        $song->album = $peticion->album;
        $song->anio = $peticion->anio;
       
        # Y guardar modelo ;)
        $song->save();
        /*
        Ahora redirige a la ruta con el nombre
        inicio (mira routes/web.php) y pásale
        un mensaje en la variable "mensaje" con
        el valor de "Canción agregada"
         */
        return redirect()
            ->route('inicio')
            ->with('mensaje', 'Canción agregada');
    }

    public function guardarCambiosDeCancion(Request $peticion)
    {
        # El id para el where de SQL
        $idCancionQueSeActualiza = $peticion->idCancion;
        # Obtener modelo fresco de la base de datos
        # Buscar o fallar
        $song = Song::findOrFail($idCancionQueSeActualiza);
        # Los nuevos datos
        $song->nombre = $peticion->nombre;
        $song->artista = $peticion->artista;
        $song->album = $peticion->album;
        $song->anio = $peticion->anio;
        # Y guardamos ;)
        $song->save();
        
        /*
        Ahora redirige a la ruta con el nombre
        inicio (mira routes/web.php) y pásale
        un mensaje en la variable "mensaje" con
        el valor de "Canción actualizada"
         */
        return redirect()
            ->route('inicio')
            ->with('mensaje', 'Canción actualizada');

    }

    public function editarCancion(Request $peticion)
    {
        $idSong = $peticion->route("id");
        # Obtener canción por ID o fallar, es decir, mostrar un 404
        $song = Song::findOrFail($idSong);
        return view("editar_cancion")
            ->with("cancion", $song);
    }

    public function eliminarCancion(Request $peticion)
    {
        # El id para el where de SQL
        $idCancionQueSeElimina = $peticion->route("id");
        # Obtener canción o mostrar 404
        $song = Song::findOrFail($idCancionQueSeElimina);
        # Eliminar
        $song->delete();
        /*
        Ahora redirige a la ruta con el nombre
        inicio (mira routes/web.php) y pásale
        un mensaje en la variable "mensaje" con
        el valor de "Canción eliminada"
         */
        return redirect()
            ->route('inicio')
            ->with('mensaje', 'Canción eliminada');
    }
}
