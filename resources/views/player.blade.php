@extends('layouts.lateral')

@section('content')
    <div id="player">
        <div class="card mt-5" id="playing">
            <img class="card-img-top" alt="Card image cap" src="">
            <div class="card-body">
                <h3 class="card-title" id="titulo"></h3>
                <p class="card-text" id="album"></p>
            </div>
        </div>
        <audio controls id="audioplayer">
            <source type="audio/mpeg" src="http://localhost/storage/music/audios/Pöls - Instinto - 11 Muros.mp3">
            Your browser does not support the audio element.
        </audio>
    </div>
    <script>
        var index = -1;
        var response;

        loadSongs();

        async function loadSongs() {
            console.log("playQueue")
            var player = document.getElementById("player");
            const queue = await fetch("/api/queue");
            response = await queue.json();
            // console.log(response)
            playNext();
            // document.getElementById("audioplayer").addEventListener("ended", playNext(), false);
            
            document.getElementById("audioplayer").addEventListener("timeupdate", function(event) { //chrome fix
                if (event.currentTarget.currentTime == event.currentTarget.duration) {
                  playNext()
                }
            });

        }


        function playNext() {
            console.log("playNext")
            index++;
            console.log(index);
            var song = response[index];
            document.querySelector("#audioplayer source").src = `http://localhost/storage/music/audios/${song.url}`;
            document.getElementById("titulo").innerHTML = song.title;
            document.getElementById("album").innerHTML = song.album_name;
            document.querySelector("#playing img").src = `/storage/music/covers/${song.cover}`;
            document.getElementById("audioplayer").load();
            document.getElementById("audioplayer").play();
        }
    </script>
@endsection
