<?php



namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class petugasController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $petugas = Petugas::all();
        return response()->json($petugas);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'petugas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|string|max:15',
            'id_user' => 'required|exists:users,id',
        ]);

        $petugas = Petugas::create($validated);

        return response()->json($petugas, 201);
    }

    /**
     * Display the specified petugas.
     */
    public function show($id)
    {
        $petugas = Petugas::findOrFail($id);
        return response()->json($petugas);
    }

    /**
     * Update the specified petugas in storage.
     */
    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $validated = $request->validate([
            'petugas' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'telp' => 'sometimes|string|max:15',
            'id_user' => 'sometimes|exists:users,id',
        ]);

        $petugas->update($validated);

        return response()->json($petugas);
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return response()->json(['message' => 'Petugas deleted successfully']);
    }
}
