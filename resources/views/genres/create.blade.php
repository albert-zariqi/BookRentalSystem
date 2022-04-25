@extends('layouts.base')

@section('content')
<h2>New genre</h2>
<form action="{{ route('genres.store') }}" method="POST">
@method("POST")
@csrf
<?php $nameField='name';
$styleField='style';
?>
<div class="row col-md-6 form-group">
    <label for="{{ $nameField }}">Name</label>
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
    <select class="form-control @error($styleField) is-invalid @enderror" name="{{$styleField}}" id="{{$styleField}}">
        <option hidden>Choose Style</option>
        @foreach ($styles as $style)
        <option value="{{ $style }}">{{ $style }}</option>
        @endforeach
    </select>

    @error($styleField)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Add genre</button>
</div>
</form>
@endsection
