@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Anime</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('anime.update', $anime->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Anime</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $anime->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $anime->genre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="episode" class="form-label">Episode Terakhir Ditonton</label>
                    <input type="number" class="form-control" id="episode" name="episode" value="{{ old('episode', $anime->last_episode) }}" required>
                </div>

                <div class="mb-3">
                    <label for="season_id" class="form-label">Season</label>
                    <select class="form-select" id="season_id" name="season_id" required>
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" {{ $anime->season_id == $season->id ? 'selected' : '' }}>
                                {{ $season->name }} {{ $season->year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="poster" class="form-label">Poster Anime</label>
                    <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
                    @if ($anime->poster)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $anime->poster) }}" alt="{{ $anime->judul }}" width="120" class="rounded shadow-sm">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('anime.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
