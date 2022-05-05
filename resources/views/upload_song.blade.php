<link rel="stylesheet" href="{{ asset('css/aiom.css') }}">
@extends('layouts.lateral')

@section('content')
<div class="container mt-5">
    <div class="content h-75">
    <h2>Sube una canción</h2>
    <form method="post" action="{{ route('addSong') }}" enctype="multipart/form-data" style="height:2rem">
        @csrf
        <div class="form-group">
            <label>Titulo de la canción:</label>
            <input type="text" name="title" placeholder="Mi canción">
        </div>
        <div class="form-group">
            <label>Archivo de música:</label>
            <input type="file" name="url" placeholder="url de la canción">
        </div>
        <div class="form-group">
            <label>Foto de la música:</label>
            <input type="file" name="cover">
        </div>
        <div class="form-group">
            <label>Album:</label>
            <input type="text" name="album_name" placeholder="Young, Wild & free">
        </div>
        <div class="form-group">
            <label>Foto Album:</label>
            <input type="file" name="album_cover">
        </div>
        <div class="form-group">
            <label>Nombre de artista:</label>
            <input type="text" name="artist_name" placeholder="Snoop">
        </div>
        <div class="form-group">
            <label>Apellido/s de artista:</label>
            <input type="text" name="artist_surname" placeholder="Dogg">
        </div>
        <div class="form-group">
            <label>Foto del artista:</label>
            <input type="file" name="artist_cover">
        </div>
        <div class="form-group">
            <label>Genero:</label>
            <input type="text" name="genre" placeholder="Rap">
        </div>
        <div class="form-group">
            <label>Foto del Genero:</label>
            <input type="file" name="genre_cover">
        </div>
        <input type="submit" value="Subir música" class="btn btn-primary text-white">
    </form>
    </div>
    <div class="footer">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (isset($success))
        @if ($success)
        <div class="alert alert-success">
            <ul class="list-unstyled">
                <li>Se ha subido con exito.</li>
            </ul>
        </div>
        @else
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                <li>No se ha podido subir su canción.</li>
            </ul>
        </div>
        @endif
    @endif
    </div>
</div>
@endsection