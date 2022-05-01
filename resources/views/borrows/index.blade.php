@extends('layouts.base')

@section('content')
<div class="container">
    <h1>@auth
        @if(Auth::user()->is_librarian)
        Rental list
        @else
        My rental list
        @endif
    @endauth</h1>
    <br/>
    <div class="row justify-content-center">
        @if(count($pending_rentals) > 0)
        <div class="col-md-6 my-4">
            <h3>PENDING Rentals</h3>
            <ul class="list-group">
                @foreach ($pending_rentals as $pending_rental)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold h5"><a href="{{route('borrows.show', $pending_rental->id)}}"> {{$pending_rental->book->title}}</a></div>
                            <small class="text-muted">Authors: </small>{{$pending_rental->book->authors}}
                        </div>
                        <span class="badge bg-light rounded-pill ">
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted ">requested: </span>{{$pending_rental->created_at}}
                            </span>
                            @if ($pending_rental->deadline)
                            <br/>
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted">deadline: </span>{{$pending_rental->deadline}}
                            </span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(count($accepted_intime) > 0)
        <div class="col-md-6 my-4">
            <h3>ACCEPTED Rentals</h3>
        <ul class="list-group">
            @foreach ($accepted_intime as $accepted)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold h5"><a href="{{route('borrows.show', $accepted->id)}}"> {{$accepted->book->title}}</a></div>
                        <small class="text-muted">Authors: </small>{{$accepted->book->authors}}
                    </div>
                    <span class="badge bg-light rounded-pill">
                        <span class="badge bg-light rounded-pill ">
                            <span class="text-muted">rental date: </span>{{$accepted->request_processed_at}}
                        </span>
                        @if ($accepted->deadline)
                        <br/>
                        <span class="badge bg-light rounded-pill">
                            <span class="text-muted">deadline: </span>{{$accepted->deadline}}
                        </span>
                        @endif
                    </span>
                </li>
            @endforeach
        </ul>
        </div>
        @endif

        @if(count($accepted_late) > 0)
        <div class="col-md-6 my-4">
            <h3>ACCEPTED Late Rentals</h3>
            <ul class="list-group">
                @foreach ($accepted_late as $accepted_late_rental)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold h5"><a href="{{route('borrows.show', $accepted_late_rental->id)}}"> {{$accepted_late_rental->book->title}}</a></div>
                            <small class="text-muted">Authors: </small>{{$accepted_late_rental->book->authors}}
                        </div>
                        <span class="badge bg-light rounded-pill">
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted">rental date: </span>{{$accepted_late_rental->request_processed_at}}
                            </span>
                            @if ($accepted_late_rental->deadline)
                            <br/>
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted">deadline: </span>{{$accepted_late_rental->deadline}}
                            </span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count($rejected_rentals) > 0)
        <div class="col-md-6 my-4">
            <h3>REJECTED Rentals</h3>
            <ul class="list-group">
                @foreach ($rejected_rentals as $rejected_rental)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold h5"><a href="{{route('borrows.show', $rejected_rental->id)}}"> {{$rejected_rental->book->title}}</a></div>
                            <small class="text-muted">Authors: </small>{{$rejected_rental->book->authors}}
                        </div>
                        <span class="badge bg-light rounded-pill">
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted">requested: </span>{{$rejected_rental->created_at}}
                            </span>
                            @if ($rejected_rental->deadline)
                            <br/>
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted">deadline: </span>{{$rejected_rental->deadline}}
                            </span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(count($returned_rentals) > 0)
        <div class="col-md-6 my-4">
            <h3>RETURNED rentals</h3>
            <ul class="list-group">
                @foreach ($returned_rentals as $returned_rental)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold h5"><a href="{{route('borrows.show', $returned_rental->id)}}"> {{$returned_rental->book->title}}</a></div>
                            <small class="text-muted">Authors: </small>{{$returned_rental->book->authors}}
                        </div>
                        <span class="badge bg-light rounded-pill">
                            <span class="badge bg-light rounded-pill">
                                <span class="text-muted ">rental date: </span>{{$returned_rental->created_at}}
                            </span>
                            @if ($returned_rental->deadline)
                            <br/>
                            <span class="badge bg-light rounded-pill ">
                                <span class="text-muted ">deadline: </span>{{$returned_rental->deadline}}
                            </span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
