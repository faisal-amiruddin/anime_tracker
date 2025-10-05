@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Season</h3>
    <a href="{{ route('season.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Season</a>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Season</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($seasons as $season)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $season->name }}</td>
            <td>{{ $season->year }}</td>
            <td>
                <a href="{{ route('season.edit', $season->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('season.destroy', $season->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus season ini?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center text-muted">Belum ada season</td></tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
