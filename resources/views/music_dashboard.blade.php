@extends('layouts.lateral')

@section('content')
<div class="container mt-5">
  <h1>Dashboard</h1>
  <h2>Random songs</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
      @forelse ($songs as $song)
      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" src="/storage/music/covers/{{$song->cover}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$song->title}}</h5>
          <p class="card-text">{{$song->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$song->album_name}}</p>
          <a href="/player/{{$song->id}}" class="btn btn-primary">Reproducir</a>&nbsp;<a href="/fav/{{$song->id}}" class="btn btn-primary">Favorito</a>
        </div>
      </div>
      @empty
      <p>No tienes música favorita aún</p>
      @endforelse
  </div>
</div>
<div class="container mt-5">
  <h2>Most favorites</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
      @forelse ($favorites_songs as $favorite)
      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" src="/storage/music/covers/{{$favorite->cover}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$favorite->title}}</h5>
          <p class="card-text">{{$favorite->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$favorite->album_name}}</p>
          <a href="/player/{{$favorite->id}}" class="btn btn-primary">Reproducir</a>&nbsp;<a href="/fav/{{$favorite->id}}" class="btn btn-primary">Favorito</a>
        </div>
      </div>
      @empty
      <p>No tienes música favorita aún</p>
      @endforelse
  </div>
</div>
<div class="container mt-5">
  <h2>Recently added songs</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
      @forelse ($recently_songs as $song)
      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" src="/storage/music/covers/{{$song->cover}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$song->title}}</h5>
          <p class="card-text">{{$song->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$song->album_name}}</p>
          <a href="/player/{{$song->id}}" class="btn btn-primary">Reproducir</a>&nbsp;<a href="/fav/{{$song->id}}" class="btn btn-primary">Favorito</a>
        </div>
      </div>
      @empty
      <p>No tienes música favorita aún</p>
      @endforelse
  </div>
</div>
<div class="container mt-5">
  <h2>Playlists</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
    @forelse ($playlists as $playlist)
      <div class="card m-2" style="width: 18rem;">
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