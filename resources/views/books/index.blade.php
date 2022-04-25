@extends('layouts.base')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if (count($books) > 0)
            @foreach ($books as $book)
                <div class="col-sm-3 my-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <p class="card-text">{{ $book->authors }}</p>
                            <p class="card-text"><small class="text-muted">{{ $book->released_at }}</small></p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Open</a>
                        </div>
                        @auth

                        @if (Auth::user()->is_librarian)
                            <div class="d-inline" style="padding: 10px;">
                                <a href="{{ route('books.edit', $book->id) }}"  class="btn btn-info">Edit</a>
                                <form action="/books/{{$book->id}}" method="POST" class="d-inline">
                                    @method("DELETE")
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        @else
            <h2>No results were found </h2>
        @endif
    </div>
</div>

@endsection
