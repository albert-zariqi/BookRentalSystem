@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name: </label>

                        <div class="col-md-6">
                            {{$user->name}}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email: </label>

                        <div class="col-md-6">
                            {{$user->email}}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="is_librarian" class="col-md-4 col-form-label text-md-end">Role: </label>

                        <div class="col-md-6">
                            @if($user->is_librarian)
                            <p>Librarian</p>
                            @else
                            <p>Reader</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
