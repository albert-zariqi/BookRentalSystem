@extends('layouts.base')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="card" >
            {{-- <div class="card-header">
            </div> --}}
            <img src="{{ $book->cover_image }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">{{ $book->title }}</h3>
                <h5 class="card-subtitle">{{ $book->authors }}</h5>
                <p class="card-text">{{ $book->description}}</p>
                <p class="card-text"><small class="text-muted">Date of publish: {{ $book->released_at }}</small></p>
                <p class="card-text"><small class="text-muted">Pages: {{ $book->pages }}</small></p>
                <p class="card-text"><small class="text-muted">ISBN: {{ $book->isbn }}</small></p>
                <p class="card-text"><small class="text-muted">Language: {{ $book->language_code }}</small></p>
                <p class="card-text"><small class="text-muted">Number of this book in the library: {{ $book->in_stock }}</small></p>
                {{-- <p class="card-text"><small class="text-muted">Number of available books: {{ $available_books }}</small></p> --}}
            </div>
            <h4 style="padding-left: 5px;">Genres: </h4>
            <hr/>
            <ul class="list-group list-group-flush">
                @foreach ($book->genres as $genre)
                    <li class="list-group-item">{{ $genre->name }}</li>
                @endforeach
            </ul>
          </div>
        <ul>
        </ul>
    </div>

</div>
@endsection
