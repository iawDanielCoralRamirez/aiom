@extends('layouts.lateral')

@section('content')
<div class="card mt-5" id="playing">
  @if(isset($song))
  <img class="card-img-top" src="/storage/music/covers/{{$song->cover}}" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title">{{$song->title}}</h3>
    <p class="card-text">{{$song->name}}</p>
  </div>
  @endif
</div>
@if(isset($song))
  <audio controls autoplay id="player">
    <source src="/storage/music/audios/{{$song->url}}" type="audio/mpeg">
  Your browser does not support the audio element.
  </audio>
@endif
@endsection 