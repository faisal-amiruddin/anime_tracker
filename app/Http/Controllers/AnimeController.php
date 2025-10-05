<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Season;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::with('season')->orderBy('created_at', 'desc')->get();
        return view('anime.index', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        return view('anime.create', compact('seasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string',
            'poster' => 'nullable|image|max:1024',
            'last_episode' => 'nullable|integer'
        ]);

        $data = $request->only(['season_id', 'title', 'genre', 'last_episode']);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Anime::create($data);

        return redirect()->route('anime.index')->with('success', 'Anime berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        $seasons = Season::orderBy('year', 'desc')->get();

        return view('anime.edit', compact('anime', 'seasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string',
            'poster' => 'nullable|image|max:2048',
            'last_episode' => 'nullable|integer',
        ]);

        $data = $request->only(['season_id', 'title', 'genre', 'last_episode']);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $anime->update($data);
        return redirect()->route('anime.index')->with('success', 'Anime berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Anime::findOrFail($id)->delete();
        return redirect()->route('anime.index')->with('success', 'Anime berhasil dihapus!');
    }
}
