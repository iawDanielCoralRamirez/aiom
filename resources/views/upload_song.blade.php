<link rel="stylesheet" href="{{ asset('css/aiom.css') }}">
@extends('layouts.reproductor')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>

</table>
<div class="container">
  <form method="post" action={{ route('addSong') }} enctype="multipart/form-data" style="height:2rem">
    @csrf
    <label>Title song</label>
    <input type="text" name="title" placeholder="my song">
    <label>Source song</label>
    <input type="file" name="url" placeholder="my song url">
    <label>Cover</label>
    <input type="file" name="cover" placeholder="cover">
    <input type="submit" value="Upload song" class="btn btn-dark text-white">
  </form>
</div>
@endsection