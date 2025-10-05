@extends('layouts.app')

@section('content')
<h3 class="mb-4">Edit Season</h3>
<form action="{{ route('season.update', $season->id) }}" method="POST" class="col-md-6">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama Season</label>
        <select name="name" class="form-select">
            @foreach(['Winter','Spring','Summer','Fall'] as $s)
                <option value="{{ $s }}" {{ $season->name == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" value="{{ $season->year }}" required>
    </div>
    <button class="btn btn-success">Update</button>
</form>
@endsection
