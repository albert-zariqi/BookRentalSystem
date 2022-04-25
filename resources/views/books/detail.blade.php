@extends('layouts.base')

@section('content')

<br/>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                <div class="card" >
                    {{-- <div class="card-header">
                    </div> --}}
                    @if ($book->cover_image)
                        <img src="{{ $book->cover_image }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{ $book->title }}</h3>
                        <br/>
                        <p class="card-text"><small class="text-muted">Authors:</small></p>
                        <h6 class="card-subtitle">{{ $book->authors }}</h6>
                        <p class="card-text">{{ $book->description}}</p>
                        <p class="card-text"><small class="text-muted">Date of publish: {{ $book->released_at }}</small></p>
                        <p class="card-text"><small class="text-muted">Pages: {{ $book->pages }}</small></p>
                        <p class="card-text"><small class="text-muted">ISBN: {{ $book->isbn }}</small></p>
                        <p class="card-text"><small class="text-muted">Language: {{ $book->language_code }}</small></p>
                        <p class="card-text"><small class="text-muted">Number of this book in the library: {{ $book->in_stock }}</small></p>
                        <p class="card-text"><small class="text-muted">Description:</small></p>
                        <p class="card-text">{{$book->description}}</p>
                    </div>
                    @auth
                    @if (Auth::user()->is_librarian)
                        <hr/>
                        <div class="d-inline">
                            <form action="/books/{{$book->id}}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-info">Edit</button>
                            </form>
                            <form action="/books/{{$book->id}}" method="POST" class="d-inline">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('books.create')}}" class="btn btn-primary">Add new book</a>
                        </div>
                        <hr/>
                    @else
                        <hr/>
                        <div class="d-inline ">
                        <p class="d-inline p-2 card-text"><span class="font-weight-bold">Active rental process: </span> {{ $active_rental }}</p>
                        <form action="{{route('borrows.store')}}" method="POST" class="d-inline p-2 ">
                            @csrf
                            <input type="hidden" name="reader_id" id="reader_id" value="{{Auth::id()}}" />
                            <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}" />
                            <input type="hidden" name="status" id="status" value="PENDING" />
                            <button type="submit" class="btn btn-success" {{ ($has_active_rental) ? "disabled" : "" }}>Borrow this book</button>
                        </form>
                        </div>
                        <hr/>
                    @endif
                    @endauth
                    <h4 style="padding-left: 5px;">Genres: </h4>
                    <hr/>
                    <ul class="list-group list-group-flush">
                        @foreach ($book->genres as $genre)
                            <li class="list-group-item list-group-item-{{$genre->style}}">
                                <a href="{{ route('genres.show', $genre->id)}}">{{$genre->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
@endsection
