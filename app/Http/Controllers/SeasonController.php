<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seasons = Season::orderBy('year', 'desc')->get();
        return view('season.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('season.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|integer'
        ]);

        Season::create($request->only('name', 'year'));

        return redirect()->route('season.index')->with('success', 'Season berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $season = Season::findOrFail($id);
        return view('season.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|integer'
        ]);

        Season::findOrFail($id)->update($request->only('name', 'year'));
        return redirect()->route('season.index')->with('success', 'Season berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Season::findOrFail($id)->delete();
        return redirect()->route('season.index')->with('success', 'Season berhasil dihapus!');
    }
}
