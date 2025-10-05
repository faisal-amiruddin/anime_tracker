@extends('layouts.app')

@section('content')
<h3 class="mb-4">Tambah Anime</h3>
<form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data" class="col-md-6">
    @csrf
    <div class="mb-3">
        <label>Poster</label>
        <input type="file" name="poster" class="form-control">
    </div>
    <div class="mb-3">
        <label>Judul Anime</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Genre</label>
        <input type="text" name="genre" class="form-control" placeholder="Contoh: Action, Fantasy">
    </div>
    <div class="mb-3">
        <label>Season</label>
        <select name="season_id" class="form-select">
            @foreach ($seasons as $s)
                <option value="{{ $s->id }}">{{ $s->name }} {{ $s->year }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Episode Terakhir Ditonton</label>
        <input type="number" name="last_episode" class="form-control" value="0">
    </div>
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
