<?php

namespace App\Http\Controllers\api;

use App\Models\Kereta;
use App\Http\Controllers\Controller;
use Database\Seeders\kereta as SeedersKereta;
use Illuminate\Http\Request;

class keretaController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $kereta = Kereta::all();
        return response()->json($kereta);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kereta' => 'required|string',
            'deskripsi' => 'required|string',
            'kelas' => 'required|string',
        ]);

        $kereta = Kereta::create($request->all());

        return response()->json(['message' => 'Kereta berhasil ditambahkan', 'data' => $kereta]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $kereta = Kereta::findOrFail($id);
        return response()->json($kereta);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $kereta = Kereta::findOrFail($id);

        $validated = $request->validate([
            'kereta' => 'required|string',
            'deskripsi' => 'required|string',
            'kelas' => 'required|string',

        ]);

        $kereta->update($validated);

        return response()->json($kereta);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $kereta = Kereta::findOrFail($id);
        $kereta->delete();

        return response()->json(['message' => 'Kereta deleted successfully']);
    }
}
