<?php

namespace App\Http\Controllers\api;

use App\Models\Pelanggan;
use App\Http\Controllers\Controller;
use Database\Seeders\pelanggan as SeedersPelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PelangganController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json($pelanggan);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIK' => 'required|string|unique:pelanggan,NIK',
            'alamat' => 'required|string',
            'telp' => 'required|string|max:20',
            'id_user' => 'required|exists:users,id',
        ]);

        $pelanggan = Pelanggan::create($request->all());

        return response()->json(['message' => 'Pelanggan berhasil ditambahkan', 'data' => $pelanggan]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return response()->json($pelanggan);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'NIK' => ['required', 'string', Rule::unique('pelanggan', 'NIK')->ignore($id)],
            'alamat' => 'required|string',
            'telp' => 'required|string|max:20',
            'id_user' => 'required|exists:users,id',
        ]);

        $pelanggan->update($validated);

        return response()->json($pelanggan);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return response()->json(['message' => 'Pelanggan deleted successfully']);
    }
}
