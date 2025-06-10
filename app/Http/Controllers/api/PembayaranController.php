<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // $userId = Auth::id();
        // $pembayaran = Pembayaran::with(['pelanggan', 'jadwal'])
        //     ->where('user_id', $userId)
        //     ->get();
        $pembayaran = Pembayaran::with(['pelanggan', 'jadwal'])->get();
        // return response()->json($pembayaran);
        $pembayaran = Pembayaran::all();
        return response()->json($pembayaran);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pembelian' => 'required|date', // sebaiknya date, bukan string
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_jadwal' => 'required|exists:jadwal,id',
        ]);

        //tanggal pembelian, id_pelanggan, id_jadwal
        $pembayaran = Pembayaran::create($request->all());



        // $pembayaran = Pembayaran::create([
        //     'tanggal_pembelian' => $request->tanggal_pembelian,
        //     'id_pelanggan' => $request->id_pelanggan,
        //     'id_jadwal' => $request->id_jadwal,
        //     'user_id' => Auth::id(),
        // ]);

        // return response()->json(['message' => 'Pembayaran berhasil ditambahkan', 'data' => $pembayaran]);
        return response()->json([
            'success' => true,
            'pembayaran_id' => $pembayaran->id
        ]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return response()->json($pembayaran);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pembelian' => 'required|date', // sebaiknya date, bukan string
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_jadwal' => 'required|exists:jadwal,id',
        ]);

        $pembayaran->update($validated);

        return response()->json($pembayaran);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json(['message' => 'Pembayaran deleted successfully']);
    }
}
