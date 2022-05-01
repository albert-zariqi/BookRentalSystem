@extends('layouts.base')

@section('content')
<h2>New book</h2>
<form action="{{ route('books.store') }}" method="POST">
@csrf
@method('POST')

<?php $nameField='title'; ?>
<div class="row col-md-6 form-group">
    <label for="{{ $nameField }}">Title</label>
    <input name="{{ $nameField }}" type="text" class="form-control @error($nameField) is-invalid @enderror" id="{{ $nameField }}" placeholder=""
        value="{{ old($nameField, '') }}"
    >

    @error($nameField)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="authors">Authors</label>
    <input type="text" name="authors" class="form-control @error('authors') is-invalid @enderror" id="authors"  value="{{ old('authors', '')}}"/>

    @error('authors')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="released_at">Released at</label>
    <input name="released_at" type="date" class="form-control @error('released_at') is-invalid @enderror" id="released_at" placeholder="" value="{{ old('released_at', '') }}">

    @error('released_at')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="pages">Pages</label>
    <input name="pages" type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" placeholder="" value="{{ old('pages', '') }}">

    @error('pages')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="isbn">ISBN</label>
    <input name="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" placeholder="" value="{{ old('isbn', '') }}">

    @error('isbn')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="language_code">Language code</label>
    <input name="language_code" type="text" class="form-control @error('language_code') is-invalid @enderror" id="language_code" placeholder="" value="{{ old('language_code', '') }}">

    @error('language_code')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', '')}}</textarea>

    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group d-flex flex-wrap @error('genres') is-invalid @enderror">
    @foreach ($genres as $genre)
    <div class="custom-control custom-switch col-sm-3">
        <input
            type="checkbox"
            name="genres[]"
            id="genre-{{ $genre->id }}"
            value="{{ $genre->id }}"
            class="custom-control-input"
        >
        <label class="custom-control-label" for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
      </div>
    @endforeach

    @error('genres')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="in_stock">In stock</label>
    <input name="in_stock" type="number" class="form-control @error('in_stock') is-invalid @enderror" id="in_stock" placeholder="" value="{{ old('in_stock', '') }}">

    @error('in_stock')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="row col-md-6 form-group">
    <label for="cover_image">Cover image url</label>
    <input name="cover_image" type="text" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" placeholder="" value="{{ old('cover_image', '') }}">

    @error('cover_image')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Add book</button>
</div>

</form>
@endsection
