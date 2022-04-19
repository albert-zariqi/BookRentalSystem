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
            <ul>
                @foreach ($genres as $genre)
                    <li><a href="{{ route('genres.show', $genre->name)}}">{{$genre->name}}</a></li>
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
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Number of users in the system</h5>
                  <p class="card-text">{{ $users }}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Number of genres</h5>
                  <p class="card-text">{{ $genres_count }}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Number of books</h5>
                  <p class="card-text">{{ $books }}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Number of active book rentals (in accepted status)</h5>
                  <p class="card-text">{{ $book_rentals }}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
    </div>

    <br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Genres</h3>
            <ul>
                @foreach ($genres as $genre)
                    <li><a href="{{ route('genres.show', $genre->id)}}">{{$genre->name}}</a></li>
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

