@extends('layouts.base')

@section('content')
<h2>{{ $genre->name }}</h2>
      <a href="{{ route('genres.edit', $genre->id) }}"  class="btn btn-primary">Edit</a>
      <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
      {{-- <a href="{{ route('projects.tracks.create', $genre->id) }}" class="btn btn-primary">Add new track</a> --}}
      <div class="row ">
        @foreach ($genre->books as $book)
        <div class="col-sm-3 my-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->description }}</p>
                    <p class="card-text">{{ $book->authors }}</p>
                    <p class="card-text"><small class="text-muted">{{ $book->released_at }}</small></p>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Open</a>
                </div>
            </div>
        </div>
        @endforeach
      </div>
@endsection
