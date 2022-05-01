<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Album;
use App\Services\UploadMusicService;
use App\Services\UploadCoverService;

use App\Exceptions\UploadFileException;

class SongController extends Controller
{
    private $uploadCoverService;
    private $uploadMusicService;
    private $song;
    private $album;
    private $artist;
    private $genre;
    private $error = '';
    public function __construct()
    {
        $this->song = new Song();
        $this->album = new Album();
        $this->artist = new Artist();
        $this->genre = new Genre();
    }
    // Devolver la vista con todas las canciones
    public function index()
    {
        $songs = Song::get();
        //var_dump("songs ",$songs);
        return view("music")
            ->with("songs", $songs);
        
    }
    

    public function addSong(Request $request,UploadMusicService $UploadMusicService, UploadCoverService $UploadCoverService)
    {   
        $success = false;
        try {
            // check parameters of request
            $isValid = $request->validate([
                'title' => 'required|max:255',
                'cover' => 'required|mimes:png,jpg,jpeg,gif,png,svg|max:40048',
                'url' => 'required|mimes:mp3,m4a,mp4,wav,wma|max:100000',
                'artist_cover' => 'mimes:png,jpg,jpeg,gif,png,svg|max:40048',
                'genre_cover' => 'mimes:png,jpg,jpeg,gif,png,svg|max:40048',
                'album_cover' => 'mimes:png,jpg,jpeg,gif,png,svg|max:40048'
            ]);
            if ($isValid) {
                $this->uploadMusicService = $UploadMusicService;
                $this->uploadCoverService = $UploadCoverService;
                $this->uploadMusicService->uploadFile($request->file('url'));
                $this->uploadCoverService->uploadFile($request->file('cover'));
                # Crear los modelos
                $song = new Song;
                $artist = new Artist;
                $album = new Album;
                $genre = new Genre;
                # Establecer propiedades leídas del formulario en cuanto a las songs
                $song->title = $request->title;
                $song->cover = $request->cover->getClientOriginalName();
                $song->url = $request->url->getClientOriginalName();
                # artistas
                $artist->name = $request->artist_name;
                $artist->suraname = $request->artist_surname;
                if($request->filled('artist_cover')) {
                    $artist->cover = $request->artist_cover->getClientOriginalName();
                }
                # album
                $album->name = $request->album_name;
                if($request->filled('album_cover')) {
                    $album->cover = $request->album_cover->getClientOriginalName();
                }
                # generos
                $genre->genre = $request->genre;
                if($request->filled('genre_cover')) {
                    $genre->cover = $request->genre_cover->getClientOriginalName();
                }
                //necessitamos vincular los albumes con los artistas (songs_x_artist)

                // necessitamos vincular los artistas con las canciones (songs_x_album)

                //necessitamos vincular los canciones con los generos (music_x_genre)

                # Y guardar los modelos
                //dd($song,$artist,$album,$genre);
                $success = $song->save();
                $artist->save();
                $album->save();
                $genre->save();
            }
        } catch (UploadFileException $exception) {
            //$this->error = $exception->getMessage();
            $this->error = $exception->customMessage();
        } catch ( \Illuminate\Database\QueryException $exception) {
            $this->error = "Error with information introduced";
        }
        //return redirect('/upload/song')->with("success",$success)/*->with("error",$error)*/;
        return view('upload_song')->with("success",$success)/*->with("error",$error)*/;
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
