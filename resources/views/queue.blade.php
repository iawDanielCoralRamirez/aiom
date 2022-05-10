@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Queue</h2>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Album</th>
          <th>Artist</th>
          <th>Queue</th>
        </tr>
      </thead>
      <tbody>
          @if (Session::get('queue') != null)
            @forelse (Session::get('queue') as $song)
                <tr>
                    <td><a class="text-decoration-none" href="/player/{{$song->id}}">{{$song->title}}</a></td>
                    <td>{{$song->album_name}}</td>
                    <td>{{$song->artist_name}}</td>
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
                    <p>Aún no tienes música en cola</p>
            @endforelse
          @else
            <p>Aún no tienes música en cola</p>
          @endif
      </tbody>
    </table>
</div>
@endsection