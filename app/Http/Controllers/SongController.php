<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song_x_artist;
use App\Models\Songs_x_album;
use App\Models\Music_x_genre;
use App\Services\UploadMusicService;
use App\Services\UploadCoverService;
use App\Services\UploadCoverAlbumService;
use App\Services\UploadCoverArtistService;
use App\Services\UploadCoverGenreService;

use App\Exceptions\UploadFileException;

class SongController extends Controller
{
    private $uploadCoverService;
    private $uploadMusicService;
    private $uploadCoverAlbumService;
    private $uploadCoverArtistService;
    private $uploadCoverGenreService;
    private $song;
    // private $album;
    // private $artist;
    // private $genre;
    private $error = '';
    public function __construct()
    {
        $this->song = new Song();
        // $this->album = new Album();
        // $this->artist = new Artist();
        // $this->genre = new Genre();
    }
    // Devolver la vista con todas las canciones
    public function index()
    {
        $songs = Song::get();
        //var_dump("songs ",$songs);
        return view("music")
            ->with("songs", $songs);
        
    }
    

    public function addSong(Request $request,
                            UploadMusicService $UploadMusicService,
                            UploadCoverService $UploadCoverService,
                            UploadCoverAlbumService $UploadCoverAlbumService,
                            UploadCoverArtistService $UploadCoverArtistService,
                            UploadCoverGenreService $UploadCoverGenreService)
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
                $songs_x_artist = new Song_x_artist;
                $songs_x_album = new Songs_x_album;
                $music_x_genre = new Music_x_genre;
                # Establecer propiedades leídas del formulario en cuanto a las songs
                $song->title = $request->title;
                $song->cover = $request->cover->getClientOriginalName();
                $song->url = $request->url->getClientOriginalName();
                # artistas
                $artist->name = $request->artist_name;
                $artist->surname = $request->artist_surname;
                if ($request->hasFile('artist_cover')) {
                    $artist->cover = $request->artist_cover->getClientOriginalName();
                    $this->uploadCoverArtistService = $UploadCoverArtistService;
                    $this->uploadCoverArtistService->uploadFile($request->file('artist_cover'));
                }
                # album
                $album->name = $request->album_name;
                if ($request->hasFile('album_cover')) {
                    $album->cover = $request->album_cover->getClientOriginalName();
                    $this->uploadCoverAlbumService = $UploadCoverAlbumService;
                    $this->uploadCoverAlbumService->uploadFile($request->file('album_cover'));
                }

                # generos
                $genre->genre = $request->genre;
                if ($request->hasFile('genre_cover')) {
                    $genre->cover = $request->genre_cover->getClientOriginalName();
                    $this->uploadCoverGenreService = $UploadCoverGenreService;
                    $this->uploadCoverGenreService->uploadFile($request->file('genre_cover'));
                }

                # Y guardar los modelos
                if ($song->save() && $artist->save() && $album->save() && $genre->save()) {
                    // Cual ha sido el ultimo insertado de cada modelo
                    $success = true;
                }
                $idsong = $song->id;
                $idartista = $artist->id;
                $idalbum = $album->id;
                $idgenre = $genre->id;
                if ($request->filled('genre')) {
                    //necessitamos vincular los canciones con los generos (music_x_genre)
                    $music_x_genre->id_song = $idsong;
                    $music_x_genre->id_genre =  $idgenre;
                    $music_x_genre->save();
                }
                if ($request->filled('album_name')) {
                    // necessitamos vincular los albumes con las canciones (songs_x_album)
                    $songs_x_album->id_song = $idsong;
                    $songs_x_album->id_album =  $idalbum;
                    $songs_x_album->save();
                }
                if ($request->filled('artist_name')) {
                    //necessitamos vincular los artistas con las canciones (songs_x_artist)
                    $songs_x_artist->id_song = $idsong;
                    $songs_x_artist->id_artist =  $idartista;
                    $songs_x_artist->save();
                }
            }
        } catch (UploadFileException $exception) {
            //$this->error = $exception->getMessage();
            $this->error = $exception->customMessage();
        }catch ( \Illuminate\Database\QueryException $exception) {
            $this->error = "Error with information introduced";
        }
        //return redirect('/upload/song')->with("success",$success)/*->with("error",$error)*/;
        return view('upload_song')
            ->with("success",$success);
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
