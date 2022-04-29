<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Services\UploadMusicService;
use App\Services\UploadCoverService;

use App\Exceptions\UploadFileException;

class SongController extends Controller
{
    private $uploadCoverService;
    private $uploadMusicService;
    private $song;
    private $error = '';
    public function __construct()
    {
        $this->song = new Song();
    }
    // Devolver la vista con todas las canciones
    public function index()
    {
        $songs = Song::get();
        //var_dump("songs ",$songs);
        return view("upload_song")
            ->with("songs", $songs);
        
    }
    

    public function addSong(Request $request,UploadMusicService $UploadMusicService, UploadCoverService $UploadCoverService)
    {   
        $success = false;
        try {


            $extMusic = substr($request->url->getClientOriginalName(), strrpos($request->url->getClientOriginalName(), '.') + 1);
            $extCover = substr($request->cover->getClientOriginalName(), strrpos($request->cover->getClientOriginalName(), '.') + 1);

            //dd($ext);
            if (($extMusic == 'mp3' || $extMusic == 'm4a'|| $extMusic == 'mp4'||$extMusic == 'wav' ||$extMusic == 'wma') && ($extCover == 'jpeg' || $extCover == 'jpg'|| $extCover == 'gif'||$extCover == 'png' ||$extCover == 'svg')) {
                $this->uploadMusicService = $UploadMusicService;
                $this->uploadCoverService = $UploadCoverService;
                $this->uploadMusicService->uploadFile($request->file('url'));
                $this->uploadCoverService->uploadFile($request->file('cover'));
                # Crear el modelo
                $song = new Song;
                
                // var_dump($request->validate([
                //     'url' => 'required|mimes:mp3|max:30048',
                //     'cover' => 'required|mimes:png,jpg,jpeg,svg|max:30048'
                // ]));
                
                # Establecer propiedades leídas del formulario
                $song->title = $request->title;
                $song->cover = $request->cover->getClientOriginalName();;
                $song->url = $request->url->getClientOriginalName();
                # Y guardar modelo ;)
                $success = $song->save();
            }
        } catch (UploadFileException $exception) {
            //$this->error = $exception->getMessage();
            $this->error = $exception->customMessage();
        } catch ( \Illuminate\Database\QueryException $exception) {
            $this->error = "Error with information introduced";
        }
        return redirect('/upload/song')->
            with("error",$this->error)->
            with("message",$success);
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
