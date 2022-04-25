@extends('layouts.base')

@section('content')

<div class="container">
    <br/>
    <div class="row">
        <div class="ml-auto">
            <a href="/genres/create" class="btn btn-primary">New genre</a>
        </div>
    </div>

    <br/>
    <div class="row justify-content-center">
        @if (count($genres) > 0)
        <ul class="col-md-12 list-group">
            @foreach ($genres as $genre)
            <li class="list-group-item list-group-item-{{$genre->style}}">
                <a href="{{ route('genres.show', $genre->id)}}">{{$genre->name}}</a>
                <div class="ml-auto float-right">
                    @auth
                        @if(Auth::user()->is_librarian)
                            <a href="/genres/{{$genre->id}}/edit" class="btn btn-info">Edit</a>
                            <form class="d-inline" method="POST" action="/genres/{{$genre->id}}">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        @endif
                    @endauth
                <div>
            </li>
            @endforeach
        </ul>
        @else
            <h2>No results were found </h2>
        @endif
    </div>
</div>

@endsection
