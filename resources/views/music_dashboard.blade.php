@extends('layouts.lateral')

@section('content')
<div class="container mt-5">
  <h2>Dashboard</h2>

  <div class="d-flex flex-row justify-content-around flex-wrap">

    {{-- @forelse (app('request')->session()->get('favoritos_songs_tmp',[]) as $favorite) --}}
    @forelse ($favorites_songs as $favorite)
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="/storage/music/covers/{{$favorite->cover}}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{$favorite->title}}</h5>
        {{-- <p class="card-text">{{$favorite->artist}}</p> --}}
        <a href="/player/{$favorite->id}" class="btn btn-primary">Reproducir</a><a href="/fav/{$favorite->id}" class="btn btn-primary">Favorito</a>
      </div>
    </div>
    @empty
    <p>No tienes música favorita aún</p>

    @endforelse
  </div>
</div>
<a href="/favorites" class="btn btn-primary m-4">Ver todas</a>
</div>
<div class="container mt-5">
  <h2>Playlists</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">

  {{-- @forelse ($playlists as $playlist)
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
    @endforelse --}}

  </div>
  <a href="/playlists" class="btn btn-primary m-4">Ver todas</a>

</div>
@endsection