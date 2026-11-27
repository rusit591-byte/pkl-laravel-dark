<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JurnalResource;
use App\Models\Jurnal;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'pembimbing') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $query = Jurnal::with(['user', 'kategori', 'komentars.user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jurnals = $query->latest('tanggal')->paginate(10)->withQueryString();

        return JurnalResource::collection($jurnals);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'pembimbing') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $jurnal = Jurnal::with(['user', 'kategori', 'komentars.user'])->find($id);
        if (! $jurnal) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:proses,disetujui,revisi',
        ]);

        $jurnal->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Status jurnal berhasil diperbarui',
            'data' => new JurnalResource($jurnal->fresh(['user', 'kategori', 'komentars.user'])),
        ], 200);
    }

    public function storeKomentar(Request $request, $id)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'pembimbing') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $jurnal = Jurnal::find($id);
        if (! $jurnal) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'isi' => 'required|string',
        ]);

        $komentar = Komentar::create([
            'jurnal_id' => $jurnal->id,
            'user_id' => $user->id,
            'isi' => $validated['isi'],
        ]);

        return response()->json([
            'message' => 'Catatan evaluasi berhasil dikirim',
            'data' => $komentar->load('user'),
        ], 201);
    }
}