@extends('layouts.base')

@section('content')
<div class="container">
    <h1>{{$user}}</h1>
    <div class="row justify-content-center">
        <ul class="col-md-12 list-group">
            @if(count($pending_rentals) > 0)
            @foreach ($pending_rentals as $pending_rental)
                <li class="list-group-item list-group-item-light">
                    <div class="col-md-12">
                    <a href="{{route('borrows.show', $pending_rental->id)}}">
                        <div class="col-md-3 d-inline">{{$pending_rental->book->title}}</div>
                        <div class="col-md-4 d-inline">{{$pending_rental->book->authors}}</div>
                        <div class="col-md-2 d-inline">{{$pending_rental->book->request_processed_at}}</div>
                        <div class="col-md-4 d-inline">{{$pending_rental->book->deadline}}</div>
                    </a>
                    </div>
                </li>
            @endforeach
            @else
            <p>Nothing to show</p>
            @endif
        </ul>
    </div>
</div>
@endsection
