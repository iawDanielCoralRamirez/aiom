@extends('layouts.lateral')

@section('content')

<div class="container mt-5">
    <h2>Edita tu perfil</h2>

    <img src="" alt="imagen de perfil">

    <form class="form-horizontal" method="post" action="##" enctype="multipart/form-data">

    <div class="form-group">
            <label class="control-label col-sm-2" for="image">Imagen de perfil:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image" placeholder="Subir imagen">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Introduce tu nombre">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Cambiar password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Nueva password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="password2">Repite la nueva password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password2" placeholder="Repite la password">
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Guardar cambios">
        <a href="/destroy" class="btn btn-primary">Eliminar cuenta</a>
    </form>
</div>



@endsection