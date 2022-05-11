@extends('layouts.lateral')

@section('content')
<div class="container mt-5">
  <h1>Dashboard</h1>
  <h2>Random songs</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
      @forelse ($songs as $song)
      <div class="card m-2 bg-dark text-white" style="width: 18rem;">
        <a href="/player/{{$song->id}}"><img class="card-img-top" src="/storage/music/covers/{{$song->cover}}" alt="Card image cap"></a>
        <div class="card-body">
          <h5 class="card-title"><a class="mt-2 text-decoration-none" href="/player/{{$song->id}}">{{$song->title}}</a></h5>
          <div class="container  d-flex">
          <p class="card-text mb-2 mt-2">{{$song->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$song->album_name}}</p>&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="mt-2" href="/player/{{$song->id}}"><i class="blue-light fa fa-play"></i></a>
          &nbsp;&nbsp;
          <form method="post" action={{ route('addFavorites') }} style="height:2rem;width:2rem;">
            @csrf
            <input type="hidden" name="id" value="{{$song->id}}">
            <input type="hidden" name="title" value="{{$song->title}}">
            <input type="hidden" name="cover" value="{{$song->cover}}">
            <input type="hidden" name="url" value="{{$song->url}}">
            <input type="hidden" name="id_account" value="{{auth()->user()->id}}">
            @if($song->id_account != null)
              <input type="submit" value="&hearts;" class="btn" style="color: red">
            @else 
              <input type="submit" value="&hearts;" class="btn" style="color:gray">
            @endif
          </form>
          </div>
        </div>
      </div>
      @empty
        <p>No tienes música aún</p>
      @endforelse
  </div>
</div>
<div class="container mt-5">
  <h2>My last favorites</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
      @forelse ($favorites_songs as $favorite)
      <div class="card m-2 bg-dark text-white" style="width: 18rem;">
        <a href="/player/{{$favorite->id}}"><img class="card-img-top" src="/storage/music/covers/{{$favorite->cover}}" alt="Card image cap"></a>
        <div class="card-body">
          <h5 class="card-title"><a class="mt-2 text-decoration-none text-white" href="/player/{{$favorite->id}}">{{$favorite->title}}</a></h5>
          <div class="container  d-flex">
          <p class="card-text mb-2 mt-2">{{$favorite->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$favorite->album_name}}</p>&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="mt-2" href="/player/{{$favorite->id}}"><i class="blue-light fa fa-play"></i></a>
          &nbsp;&nbsp;
          <form method="post" action={{ route('addFavorites') }} style="height:2rem;width:2rem;">
            @csrf
            <input type="hidden" name="id" value="{{$favorite->id}}">
            <input type="hidden" name="title" value="{{$favorite->title}}">
            <input type="hidden" name="cover" value="{{$favorite->cover}}">
            <input type="hidden" name="url" value="{{$favorite->url}}">
            <input type="hidden" name="id_account" value="{{auth()->user()->id}}">
            @if($favorite->id_account != null)
              <input type="submit" value="&hearts;" class="btn" style="color: red">
            @else 
              <input type="submit" value="&hearts;" class="btn" style="color:gray">
            @endif
          </form>
          </div>
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
      <div class="card m-2 bg-dark text-white" style="width: 18rem;">
        <a class="text-decoration-none text-dark" href="/player/{{$song->id}}"><img class="card-img-top" src="/storage/music/covers/{{$song->cover}}" alt="Card image cap"></a>
        <div class="card-body">
          <h5 class="card-title"><a class="mt-2 text-decoration-none text-white" href="/player/{{$song->id}}">{{$song->title}}</a></h5>
          <div class="container  d-flex">
          <p class="card-text mb-2 mt-2">{{$song->artist_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$song->album_name}}</p>&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="mt-2" href="/player/{{$song->id}}"><i class="blue-light fa fa-play"></i></a>
          &nbsp;&nbsp;
          <form method="post" action={{ route('addFavorites') }} style="height:2rem;width:2rem;">
            @csrf
            <input type="hidden" name="id" value="{{$song->id}}">
            <input type="hidden" name="title" value="{{$song->title}}">
            <input type="hidden" name="cover" value="{{$song->cover}}">
            <input type="hidden" name="url" value="{{$song->url}}">
            <input type="hidden" name="id_account" value="{{auth()->user()->id}}">
            @if($song->id_account != null)
              <input type="submit" value="&hearts;" class="btn" style="color: red">
            @else 
              <input type="submit" value="&hearts;" class="btn" style="color:gray">
            @endif
          </form>
          </div>
        </div>
      </div>
      @empty
      <p>No hay música recientemente añadida</p>
      @endforelse
  </div>
</div>
<div class="container mt-5">
  <h2>Playlists</h2>
  <div class="d-flex flex-row justify-content-around flex-wrap">
    @forelse ($playlists as $playlist)
      <div class="card bg-dark text-white m-2" style="width: 18rem;">
        @if ($playlist->cover != null)
          <img class="card-img-top" src="storage/playlist/covers/{{ $playlist->cover }}" alt="Card image cap">
        @else 
          <img class="card-img-top" src="img/default-playlist.jpeg" alt="Card image cap">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{$playlist->name}}</h5>
          <a href="/playlists/{{$playlist->id}}" class="btn btn-primary text-white">Ir a la playlist</a>
        </div>
      </div>
      @empty
      <p>No tienes playlist guardadas aún</p>
    @endforelse
  </div>
</div>
@endsection