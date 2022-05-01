@extends('layouts.base')

@section('content')
<h2>Edit genre</h2>
<form action="{{ route('genres.update',$genre->id) }}" method="POST">
@method("PUT")
@csrf
<?php $nameField='name';
$styleField='style';
?>
<div class="row col-md-6 form-group">
    <label for="{{ $nameField }}">Name</label>
    <input name="{{ $nameField }}" type="text" class="form-control @error($nameField) is-invalid @enderror" id="{{ $nameField }}" placeholder=""
        value="{{ old($nameField, $genre[$nameField]) }}"
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
        <option value="{{ $style }}"
        @if($genre->style == $style)
            @selected(true)
        @endif
        >{{ $style }}</option>
        @endforeach
    </select>

    @error($styleField)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Update genre</button>
</div>
</form>
@endsection
