<link rel="stylesheet" href="{{ asset('css/aiom.css') }}">
@extends('layouts.lateral')

@section('content')
    <div class="container">
        <form method="post" action={{ route('addSong') }} enctype="multipart/form-data" style="height:2rem">
            @csrf
            <label>Titulo de la canción:</label>
            <input type="text" name="title" placeholder="Mi canción">
            <label>Archivo de música:</label>
            <input type="file" name="url" placeholder="url de la canción">
            <label>Foto de la música:</label>
            <input type="file" name="cover">
            <label>Album:</label>
            <input type="text" name="album_name" placeholder="Young, Wild & free">
            <label>Foto Album:</label>
            <input type="file" name="album_cover">
            <label>Nombre de artista:</label>
            <input type="text" name="artist_name" placeholder="Snoop">
            <label>Apellido/s de artista:</label>
            <input type="text" name="artist_surname" placeholder="Dogg">
            <label>Foto del artista:</label>
            <input type="file" name="artist_cover">
            <label>Genero:</label>
            <input type="text" name="genre" placeholder="Rap">
            <label>Foto del Genero:</label>
            <input type="file" name="genre_cover">
            <input type="submit" value="Subir música" class="btn btn-dark text-white">
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (isset($success))
            @if ($success)
                <div class="alert alert-success">
                    <ul>
                        <li>Se ha subido con exito.</li>
                    </ul>
                </div>
            @else
                <div class="alert alert-danger">
                    <ul>
                        <li>No se ha podido subir su canción.</li>
                    </ul>
                </div>
            @endif
        @endif
    </div>
@endsection