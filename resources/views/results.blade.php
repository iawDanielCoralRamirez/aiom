@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Resultados de búsqueda</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Artist</th>
          <th>Favorito</th>
          <th>Añadir a playlist</th>
        </tr>
      </thead>
      <tbody>
      @forelse ($songs as $song)
        <tr>
          <td><a class="text-decoration-none" href="/player/{{$song->id}}">{{$song->title}}</a></td>
          <td>{{$song->album_name}}</td>
          <td>{{$song->artist_name}}</td>
          <td>
            {{-- <form method="post" action="music/{{ route('addFavorites') }}/{{$song->id}}" class="" style="height:2rem">
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
            </form> --}}
            <i id="{{$song->id}}" onclick="addFavorites(event, {{$song->id}});" class="fa fa-heart" style="color:gray;"></i>
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
        </tr>
        @empty
          <p>No hemos encontrado nada de eso :(</p>
      @endforelse
      </tbody>
    </table>
</div>
<script>
  var hearts = document.getElementsByClassName("fa fa-heart");
  for (var heart = 0; heart < hearts.length; heart++) {
      if (hearts[heart].id != "") {
        console.log(hearts[heart].id);
        console.log(localStorage.getItem(hearts[heart].id));
        hearts[heart].style.color = localStorage.getItem(hearts[heart].id);
      }
  }
  async function addPlaylist(e, songid){
    const response = await fetch(`/api/playlist/addSong?playlist_id=${e.target.value}&song_id=${songid}`);
    //terminar añadiendo info con javascript en el listado
    console.log(response);
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
    if (localStorage.getItem(songid) == "red") {
      e.target.style.color = "gray";
      localStorage.setItem(songid,"gray");
    }else {
      e.target.style.color = "red";
      localStorage.setItem(songid,"red");
      
    }
  }
</script>
@endsection


