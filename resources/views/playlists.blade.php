@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Playlists</h2>

    <div class="d-flex flex-row justify-content-around flex-wrap">

    @forelse ($playlists as $playlist)
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="{{$playlist->img}}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{$playlist->title}}</h5>
        <p class="card-text">{{$playlist->autor}}</p>
        <a href="/playlist/{{$playlist->id}}" class="btn btn-primary">Ir a la playlist</a>
      </div>
    </div>

    @empty
    <p>No tienes playlist guardadas aún</p>
    @endforelse
    
    </div>
</div>


@endsection