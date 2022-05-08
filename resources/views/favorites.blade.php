@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Favoritos</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Autor</th>
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
              <form method="post" action={{ route('addFavorites') }} class="" style="height:2rem">
                  @csrf
                  <input type="hidden" name="id" value="{{$favorite->id}}">
                  <input type="hidden" name="title" value="{{$favorite->title}}">
                  <input type="hidden" name="cover" value="{{$favorite->cover}}">
                  <input type="hidden" name="url" value="{{$favorite->url}}">
                  <input type="hidden" name="id_account" value="{{auth()->user()->id}}">
                  <input type="submit" value="&hearts;" class="btn " style="color: red !important">
              </form>
            </td>
          </tr>
          @empty
            <p>Aún no tienes música favorita</p>
        @endforelse
      </tbody>
    </table>
</div>
@endsection