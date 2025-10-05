@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Anime</h3>
    <a href="{{ route('anime.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Anime</a>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @forelse($animes as $anime)
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card shadow-sm h-100">
            @if ($anime->poster)
                <img src="{{ asset('storage/' . $anime->poster) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
            @else
                <img src="https://via.placeholder.com/300x250?text=No+Image" class="card-img-top">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $anime->title }}</h5>
                <p class="card-text"><small>{{ $anime->genre }}</small></p>
                <p class="mb-1"><i class="bi bi-calendar"></i> {{ $anime->season->name }} {{ $anime->season->year }}</p>
                <p><i class="bi bi-collection-play"></i> Episode terakhir: {{ $anime->last_episode }}</p>
                <a href="{{ route('anime.edit', $anime->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('anime.destroy', $anime->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus anime ini?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info text-center">Belum ada anime</div>
    @endforelse
</div>
@endsection
