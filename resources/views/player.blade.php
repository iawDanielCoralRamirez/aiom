<img id="cover" src="{{$song->cover}}" >
<p>{{ $song->title }}</p>
<p>{{ $song->autor }}</p>

<audio controls>
  <source src="{{$song->file}}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>