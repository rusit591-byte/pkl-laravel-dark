<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Http\Resources\JurnalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    // Menampilkan daftar jurnal milik pengguna yang sedang login
    public function index(Request $request)
    {
        $jurnals = Jurnal::where('user_id', Auth::id())->with('kategori')->latest()->get();
        return JurnalResource::collection($jurnals);
    }

    // Menambah jurnal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'     => 'required|date',
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'   => 'required|string',
        ]);

        $jurnal = Jurnal::create([
            'user_id'     => Auth::id(),
            'tanggal'     => $validated['tanggal'],
            'judul'       => $validated['judul'],
            'kategori_id' => $validated['kategori_id'],
            'deskripsi'   => $validated['deskripsi'],
            'status'      => 'proses',
        ]);

        return response()->json([
            'message' => 'Jurnal berhasil ditambahkan',
            'data'    => new JurnalResource($jurnal)
        ], 201); // Kode status 201 Created
    }

    // Menampilkan detail jurnal tertentu
    public function show($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Cek kepemilikan (jika bukan miliknya, kembalikan 403 Forbidden)
        if ($jurnal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        return new JurnalResource($jurnal);
    }

    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($jurnal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $validated = $request->validate([
            'tanggal'     => 'required|date',
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'   => 'required|string',
        ]);

        $jurnal->update($validated);

        return response()->json([
            'message' => 'Jurnal berhasil diperbarui',
            'data'    => new JurnalResource($jurnal)
        ], 200);
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($jurnal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $jurnal->delete();

        return response()->json(['message' => 'Jurnal berhasil dihapus'], 200);
    }
}