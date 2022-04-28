<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Services\UploadFileService;

use App\Exceptions\UploadFileException;

class SongController extends Controller
{
    // Devolver la vista con todas las canciones
    public function index()
    {
        $songs = Song::get();
        //var_dump("songs ",$songs);
        return view("upload_song")
            ->with("songs", $songs);
        
    }
    

    public function addSong(Request $request,UploadFileService $UploadFileService)
    {
        try {
            $this->uploadService = $UploadFileService;
            $this->uploadService->uploadFile($request->file('url'));
            # Crear un modelo...
            $song = new Song;
            $request->validate([
                'url' => 'required|mimes:mp3|max:30048',
                'cover' => 'required|mimes:png,jpg,jpeg,svg|max:30048'
            ]);
            # Establecer propiedades leídas del formulario
            
            $song->title = $request->title;
            
            //var_dump("request-title",$request->title);
            var_dump("request-url",$request->url);
            //$upload = $request->file('arquivo')->storeAs('products', 'novonomeaffffff.jpg');public//tmp/
            //$filePath = $request->file('url')->storeAs('uploads', $request->url);
            //$filePath = $request->file('url')->store('public');
            $coverPath = $request->file('cover')->store('public');
            //$filePath = $request->file->move(public_path('uploads'), $request->url);
            $song->cover = $coverPath;
            //$song->url =$filePath;
            $song->url = $request->imagen->getClientOriginalName();
            
        
            # Y guardar modelo ;)
            $song->save();
        } catch (UploadFileException $exception) {
            //$this->error = $exception->getMessage();
            $this->error = $exception->customMessage();
        } catch ( \Illuminate\Database\QueryException $exception) {
            $this->error = "Error con los datos introducidos";
        }
        return view('upload_song');
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
