@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Tu música</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Artist</th>
          <th>Favorito</th>
          <th>Añadir a playlist</th>
          <th>Añadir a la cola</th>
        </tr>
      </thead>
      <tbody>
      @forelse ($songs as $song)
        <tr>
          <td><a class="text-decoration-none" href="/player/{{$song->id}}">{{$song->title}}</a></td>
          <td>{{$song->album_name}}</td>
          <td>{{$song->artist_name}}</td>
          <td>
            <input onclick="addFavorites(event, {{$song->id}});" type="button" value="&hearts;" class="btn" style="color:gray">
          </td>
          <td>
            <select onchange="addPlaylist(event, {{$song->id}})">
              <option selected>Selecciona un playlist...</option>
              @forelse ($playlists as $playlist)
              <option value="{{$playlist->id}}">{{$playlist->name}}</option>
              @empty
              <option>sin playlists</option>
              @endforelse
            </select>
          </td>
          <td>
            <form method="post" action={{ route('addQueue') }} style="height:2rem">
              @csrf
              <input type="hidden" name="id" value="{{$song->id}}">
              <input type="hidden" name="title" value="{{$song->title}}">
              <input type="hidden" name="cover" value="{{$song->cover}}">
              <input type="hidden" name="url" value="{{$song->url}}">
              <input type="hidden" name="id_account" value="{{auth()->user()->id}}">
              <input type="submit" value="+" class="btn" style="color: gray">
            </form>
          </td>
        </tr>
        @empty
          <p>Aún no has subido música</p>
      @endforelse
      </tbody>
    </table>
</div>
<script>
  async function addPlaylist(e, songid){
    const response = await fetch(`/api/playlist/addSong?playlist_id=${e.target.value}&song_id=${songid}`);
    console.log(e.target.firstChild)
    alert("Añadida a la playlist!");
  }
  async function addFavorites(e,songid){
    fetch(`music/addFavorites/${songid}`, {
    method: "post",
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      songid: songid,
    })
    }).then( (response) => { /*console.log(response);*/ });
    if (e.target.style.color == "red") {
      e.target.style.color = "gray";
    }else {
      e.target.style.color = "red";
    }
  }
</script>
@endsection


