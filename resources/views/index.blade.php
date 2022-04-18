@extends('layouts.base')


@section('content')

<div class="row">
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
              <p class="card-text">{{ $genres }}</p>
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
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


@endsection
