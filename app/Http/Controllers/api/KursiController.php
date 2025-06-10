<?php

namespace App\Http\Controllers\api;

use App\Models\kursi;
use App\Http\Controllers\Controller;
use Database\Seeders\kereta as SeedersKereta;
// use Database\Seeders\kursi;
use Illuminate\Http\Request;

class kursiController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $kursi = Kursi::all();
        return response()->json($kursi);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kursi' => 'required|string',
            'id_gerbong' => 'required|exists:gerbong,id',
        ]);

        $kursi = Kursi::create($request->all());

        return response()->json(['message' => 'Kursi berhasil ditambahkan', 'data' => $kursi]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $kursi = Kursi::findOrFail($id);
        return response()->json($kursi);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $kursi = Kursi::findOrFail($id);

        $validated = $request->validate([
            'no_kursi' => 'required|string',
            'id_gerbong' => 'required|exists:gerbong,id',

        ]);

        $kursi->update($validated);

        return response()->json($kursi);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $kursi = Kursi::findOrFail($id);
        $kursi->delete();

        return response()->json(['message' => 'Kursi deleted successfully']);
    }
}
