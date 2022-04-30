@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Tu música</h2>
    
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
      @forelse ($songs as $song)
        <tr>
          <td>{{$song->title}}</td>
          <td>{{$song->album}}</td>
          <td>{{$song->autor}}</td>
          <td><i class="fa fa-fw fa-heart"></i></td>
        </tr>
        @empty
          <p>Aún no has subido música</p>
      @endforelse
      </tbody>
    </table>
</div>
@endsection