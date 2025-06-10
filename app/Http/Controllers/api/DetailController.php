<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $detail = Detail::all();
        return response()->json($detail);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIK' => 'required|string|unique:pelanggan,NIK',
            'id_pembelian_tiket' => 'required|string',
            'id_gerbong' => 'required|exists:gerbong,id',
            'id_kursi' => 'required|exists:kursi,id',
            'metode_pembayaran' => 'required|string',
        ]);

        $detail = Detail::create($request->all());

        // return response()->json(['message' => 'Detail berhasil ditambahkan', 'data' => $detail]);
        return response()->json([
            'success' => true,
            'data' => $detail
        ]);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $detail = Detail::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $detail
        ]);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $detail = Detail::findOrFail($id);

        $validated = $request->validate([
            'NIK' => ['required', 'string', Rule::unique('pelanggan', 'NIK')->ignore($id)],
            'id_pembelian_tiket' => 'required|string',
            'id_gerbong' => 'required|exists:gerbong,id',
            'id_kursi' => 'required|exists:kursi,id',
            'metode_pembayaran' => 'required|string',

        ]);

        $detail->update($validated);

        return response()->json($detail);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $detail = Detail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Detail deleted successfully']);
    }

    public function downloadPdf($id)
    {
        $detail = Detail::findOrFail($id);
        $pdf = Pdf::loadView('pdf.detail', compact('detail'));
        return $pdf->download('tiket-' . $detail->id . '.pdf');
    }
}
