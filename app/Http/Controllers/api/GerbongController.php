<?php

namespace App\Http\Controllers\api;

use App\Models\Gerbong;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class gerbongController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $gerbong = Gerbong::all();
        return response()->json($gerbong);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gerbong' => 'required|string',
            'kelas' => 'required|string',
            // 'id_kereta' => 'required|exists:kereta,id',
            'id_kereta' => 'required|integer',
        ]);

        $gerbong = Gerbong::create($request->all());

        return response()->json(['message' => 'Gerbong berhasil ditambahkan', 'data' => $gerbong]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $gerbong = Gerbong::findOrFail($id);
        return response()->json($gerbong);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $gerbong = Gerbong::findOrFail($id);

        $validated = $request->validate([
            'gerbong' => 'required|string',
            'kelas' => 'required|string',
            // 'id_kereta' => 'required|exists:kereta,id',
            'id_kereta' => 'required|integer',

        ]);

        $gerbong->update($validated);

        return response()->json($gerbong);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $gerbong = Gerbong::findOrFail($id);
        $gerbong->delete();

        return response()->json(['message' => 'Gerbong deleted successfully']);
    }
}
