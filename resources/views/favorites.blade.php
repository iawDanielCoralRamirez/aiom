@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Favoritos</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Artist</th>
          <th>Favorito</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($favorites_songs as $favorite)
          <tr>
            <td><a class="text-decoration-none" href="/player/{{$favorite->id}}">{{$favorite->title}}</a></td>
            <td>{{$favorite->album_name}}</td>
            <td>{{$favorite->artist_name}}</td>
            <td>
              <input onclick="addFavorites(event, {{$favorite->id}});" type="button" value="&hearts;" class="btn" style="color:red">
            </td>
          </tr>
          @empty
            <p>Aún no tienes música favorita</p>
        @endforelse
      </tbody>
    </table>
</div>
<script>
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
      e.target.parentNode.parentNode.style.display = "none";
    }
  }
</script>
@endsection