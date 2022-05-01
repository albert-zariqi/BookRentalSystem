@extends('layouts.base')

@section('content')

<br/>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="d-flex justify-content-center">
                <div class="card" style="flex: 0 0 50%; min-width: 100%;">
                    {{-- <div class="card-header">
                    </div> --}}
                    <div class="card-body">
                        <h3 class="card-title">{{ $borrow->book->title }}</h3>
                        <br/>
                        <p class="card-text"><small class="text-muted">Authors: &nbsp;</small> <span class="h6">{{ $borrow->book->authors }}</span></p>
                        <p class="card-text"><small class="text-muted">Date of publish: {{ $borrow->book->released_at }}</small></p>
                        <a href="{{route('books.show', $borrow->book->id)}}" class="btn btn-primary">Open</a>
                        <hr/>
                        <p class="card-text"><small class="text-muted">Reader: {{ $borrow->reader->name }}</small></p>
                        <p class="card-text"><small class="text-muted">Date of rental request: {{ $borrow->created_at }}</small></p>
                        <p class="card-text"><small class="text-muted">Status: {{ $borrow->status }}</small></p>
                        @if($borrow->status == 'RETURNED')
                            <p class="card-text"><small class="text-muted">Date of return: {{ $borrow->returned_at }}</small></p>
                            <p class="card-text"><small class="text-muted">Return managed by: {{ $borrow->librarianManageReturns->name }}</small></p>

                        @elseif ($borrow->status != 'PENDING')
                            <p class="card-text"><small class="text-muted">Request processed at: {{ $borrow->request_processed_at }}</small></p>
                            <p class="card-text"><small class="text-muted">Managed by: {{ $borrow->librarianManageRentals->name }}</small></p>
                            @if($borrow->deadline && $borrow->deadline < now())
                                <p class="card-text"><small class="text-muted">Deadline: {{ $borrow->deadline }}</small></p>
                                <p class="card-text text-danger"><b>The rental is late</b> </p>
                            @endif
                        @endif

                        @if(Auth::user()->is_librarian)
                        <hr/>
                        <form method="POST" action="{{route('borrows.update', $borrow->id)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="returned_at" value="" />
                            <input type="hidden" name="return_managed_by" value="{{Auth::id()}}" />
                            <div class="row mb-3">
                                <label for="deadline">Deadline</label>
                                <input name="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" placeholder="" value="{{ old('deadline',  $borrow->deadline) }}">

                                @error('deadline')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Status: </label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option hidden>Choose Status</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status }}"
                                    @if($borrow->status == $status)
                                        @selected(true)
                                    @endif
                                    >{{ $status }}</option>
                                    @endforeach
                                </select>

                                @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update rental
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
