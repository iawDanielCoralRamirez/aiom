<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>All In One Music</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/aiom.css">
        {{-- <style>
            .oscuro{
                background-color: #2E282A;
            }
        </style> --}}

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-4 oscuro">
                    <ul>
                        <li><a href="#">Favoritos</a></li>
                        <li><a href="#">Playlists</a></li>
                        <li><a href="#">Mi música</a></li>
                        <li><a href="#">Mi perfil</a></li>
                    </ul>
                </div>
                <div class="col-8">

                    {{-- {{ $slot }} --}}

                </div>
                
              </div>
        </div>
        <footer>
            {{-- reproductor --}}
        </footer>
    </body>
</html>