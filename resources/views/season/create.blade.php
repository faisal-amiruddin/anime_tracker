@extends('layouts.app')

@section('content')
<h3 class="mb-4">Tambah Season</h3>
<form action="{{ route('season.store') }}" method="POST" class="col-md-6">
    @csrf
    <div class="mb-3">
        <label>Nama Season</label>
        <select name="name" class="form-select">
            <option value="Winter">Winter</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
            <option value="Fall">Fall</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
