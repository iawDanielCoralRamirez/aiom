<link rel="stylesheet" href="{{ asset('css/aiom.css') }}">
@extends('layouts.lateral')

@section('content')
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
      {{-- @if($errors->any())
          @foreach ($errors->all() as $error)
            <p class="border border border-danger rounded-md bg-red-100 w-full text-red-600 p-2 mt-2">{{$error}}</p>
          @endforeach 
      @endif --}}
      {{-- @if(isset($error))
        <p class="border border border-danger rounded-md bg-red-100 w-full text-red-600 p-2 mt-2">{{$success}}</p>
      @endif  --}}
      {{-- @if(isset($success) && $success == false)
      <p class="border border border-danger rounded-md bg-red-100 w-full text-red-600 p-2 mt-2">{{$success}}</p>
      @endif --}}
      @if(isset($success))
      <p class="border border border-danger rounded-md bg-red-100 w-full text-red-600 p-2 mt-2">No se ha podido realizar la operación.</p>
      @endif
    </div>
</table>
@endsection