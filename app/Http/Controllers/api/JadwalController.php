<?php

namespace App\Http\Controllers\api;

use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Database\Seeders\JadwalSeeder as SeedersKereta;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return response()->json($jadwal);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asal_keberangkatan' => 'required|string',
            'tujuan_keberangkatan' => 'required|string',
            'keberangkatan' => 'required|date',
            'kedatangan' => 'required|date',
            'harga' => 'required|numeric',
            'id_kereta' => 'required|exists:kereta,id',
        ]);

        $jadwal = Jadwal::create($request->all());

        return response()->json(['message' => 'Jadwal berhasil ditambahkan', 'data' => $jadwal]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return response()->json($jadwal);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $validated = $request->validate([
            'asal_keberangkatan' => 'required|string',
            'tujuan_keberangkatan' => 'required|string',
            'keberangkatan' => 'required|date',
            'kedatangan' => 'required|date',
            'harga' => 'required|numeric',
            'id_kereta' => 'required|exists:kereta,id',
        ]);

        $jadwal->update($validated);

        return response()->json($jadwal);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json(['message' => 'Jadwal deleted successfully']);
    }
}
