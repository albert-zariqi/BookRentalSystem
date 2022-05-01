@extends('layouts.base')

@section('content')
<div class="container">
    @guest
    <br/>
    <div class="row justify-content-center">
        <form method="GET" action="{{ route('search') }}">
            @csrf
            <div class="input-group">
                <div class="form-outline">
                  <input id="search-focus" type="search" name="search_text" class="form-control" placeholder="Search..."/>
                </div>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
        </form>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Genres</h3>
            <ul class="col-md-12 list-group">
                @foreach ($genres as $genre)
                        <li class="list-group-item list-group-item-{{$genre->style}}">
                            <a href="{{ route('genres.show', $genre->id)}}">{{$genre->name}}</a>
                        </li>
                            {{-- <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Open</a> --}}
                @endforeach
            </ul>
        </div>
    </div>
    @else
    <br/>
    <div class="row justify-content-center">
        <form method="GET" action="{{ route('search') }}">
            @csrf
            <div class="input-group">
                <div class="form-outline">
                  <input id="search-focus" type="search" name="search_text" class="form-control" placeholder="Search..."/>
                </div>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
        </form>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-dark bg-light mb-3"  style="flex: 0 0 50%; min-width: 50%;">
                <div class="card-body">
                  <h4 class="card-title">Number of users in the system</h4>
                  <hr/>
                  <p class="card-text text-center h5">{{ $users }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3"  style="flex: 0 0 50%; min-width: 50%;">
                <div class="card-body">
                  <h4 class="card-title">Number of genres</h4>
                  <hr/>
                  <p class="card-text text-center h5">{{ $genres_count }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3" style="flex: 0 0 50%; min-width: 50%;">
                <div class="card-body">
                  <h4 class="card-title">Number of books</h5>
                  <hr/>
                  <p class="card-text text-center h5">{{ $books }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3"  style="flex: 0 0 50%; min-width: 50%;">
                <div class="card-body">
                  <h4 class="card-title">Number of active book rentals</h4>
                  <hr/>
                  <p class="card-text text-center h5">{{ $book_rentals }}</p>
                </div>
            </div>
        </div>
    </div>

    <br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Genres</h3>
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
        </div>
    </div>
    @endguest

</div>
<script>
    const searchFocus = document.getElementById('search-focus');
    const keys = [
    { keyCode: 'AltLeft', isTriggered: false },
    { keyCode: 'ControlLeft', isTriggered: false },
    ];

    window.addEventListener('keydown', (e) => {
    keys.forEach((obj) => {
        if (obj.keyCode === e.code) {
        obj.isTriggered = true;
        }
    });

    const shortcutTriggered = keys.filter((obj) => obj.isTriggered).length === keys.length;

    if (shortcutTriggered) {
        searchFocus.focus();
    }
    });

    window.addEventListener('keyup', (e) => {
    keys.forEach((obj) => {
        if (obj.keyCode === e.code) {
        obj.isTriggered = false;
        }
    });
    });
</script>
@endsection

