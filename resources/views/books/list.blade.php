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
                            <a href="{{ route('books.detail', $book->id) }}" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h2>No results were found </h2>
        @endif
    </div>
</div>

@endsection
