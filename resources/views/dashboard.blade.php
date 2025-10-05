@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Dashboard</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        // Ambil semua season dengan relasi anime
        $seasons = \App\Models\Season::with('animes')->orderBy('year', 'desc')->get();
    @endphp

    @forelse($seasons as $season)
    <div class="mb-5">
        <h5 class="mb-3">{{ $season->name }} {{ $season->year }}</h5>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($season->animes as $anime)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($anime->poster)
                        <img src="{{ asset('storage/' . $anime->poster) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x250?text=No+Image" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $anime->title }}</h6>
                        <p class="card-text text-truncate"><small>{{ $anime->genre }}</small></p>
                        <p class="mb-0"><small>Episode terakhir: {{ $anime->last_episode }}</small></p>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted ms-3">Belum ada anime untuk season ini.</p>
            @endforelse
        </div>
    </div>
    @empty
    <div class="alert alert-info">Belum ada season & anime. Tambahkan season dan anime dulu.</div>
    @endforelse
</div>
@endsection
