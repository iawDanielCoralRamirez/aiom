@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>{{$playlist->name}}</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Autor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @forelse ($songs as $song)
        <tr>
          <td><a class="text-decoration-none" href="/player/{{$song->id}}">{{$song->title}}</a></td>
          <td>{{$song->album}}</td>
          <td>{{$song->name}}</td>
          <td>
            <a class="text-decoration-none" href="/playlist/{{$playlist->id}}/deleteSong/{{$song->id}}">Borrar canción</a>
          </td>
        </tr>
        @empty
          <p>Esta playlist está vacía</p>
      @endforelse
      </tbody>
    </table>
    <a href="/playlists/delete/{{ $playlist->id }}" class="btn btn-danger">Eliminar playlist</a>
</div>
@endsection