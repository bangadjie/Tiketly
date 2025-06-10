<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Jadwal;
use App\Models\Transaksi;


// class TransaksiController extends Controller
// {
//     public function store(Request $request)
//     {
//         $request->validate([
//             'jadwal_id' => 'required|exists:jadwals,id',
//             'gerbong' => 'required|integer',
//             'kursi' => 'required|integer',
//         ]);

//         $transaksi = Transaksi::create([
//             'user_id' => auth()->id(),
//             'jadwal_id' => $request->jadwal_id,
//             'gerbong_id' => $request->gerbong,
//             'kursi_id' => $request->kursi,
//         ]);

        // Logic PDF jika perlu...
        // return PDF::download('tiket.pdf');

//         return response()->json(['message' => 'Tiket berhasil dipesan', 'transaksi' => $transaksi]);
//     }


//     public function history()
//     {
//         $userId = auth()->id();

//         $history = Transaksi::with(['jadwal', 'gerbong', 'kursi'])
//             ->where('user_id', $userId)
//             ->orderBy('created_at', 'desc')
//             ->get();

//         return response()->json($history);
//     }
// }

// $pdf = Pdf::loadView('pdf.tiket', $data);
        // return $pdf->download('tiket.pdf');
