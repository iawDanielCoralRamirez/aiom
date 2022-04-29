<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>All In One Music</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/aiom.css">
    {{-- iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 lateral pt-5">
                <div class="menu">
                    <h3 class="text-center ">Nombre de Usuario</h3>
                    <ul class="pt-3 pl-5">
                        <li><a href="#"><i class="fa fa-fw fa-heart"></i>Favoritos</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-music"></i>Playlists</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-database"></i>Mi música</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-wrench"></i>Mi perfil</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary" id="logout" href="/logout">Salir</a>
            </div>
            <div class="col-sm-10 content">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- <div class="container container-nomargin">
                <div class="lateral">
                    <h3>Nombre de Usuario</h3>
                    <ul>
                        <li><a href="#">Favoritos</a></li>
                        <li><a href="#">Playlists</a></li>
                        <li><a href="#">Mi música</a></li>
                        <li><a href="#">Mi perfil</a></li>
                    </ul>
                    <a class="btn btn-primary" src="/logout">Salir</a>
                </div>
                <div class="pagina">

                    @yield('content')

                </div>
        </div> --}}



</body>

</html>
