<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    // Menampilkan daftar seluruh jurnal peserta (dengan filter per peserta)
    public function index(Request $request)
    {
        $query = Jurnal::with(['user', 'kategori', 'komentars.user']);

        // Filter berdasarkan peserta tertentu jika dipilih
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $jurnals = $query->latest('tanggal')->paginate(5)->withQueryString();

        // Ambil daftar user yang rolenya 'peserta' untuk pilihan dropdown filter
        $pesertas = User::where('role', 'peserta')->get();

        return view('pembimbing.jurnals.index', compact('jurnals', 'pesertas'));
    }

    // Menyimpan komentar/catatan dari pembimbing pada jurnal tertentu
    public function storeKomentar(Request $request, Jurnal $jurnal)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        Komentar::create([
            'jurnal_id' => $jurnal->id,
            'user_id'   => Auth::id(),
            'isi'       => $request->isi,
        ]);

        return back()->with('success', 'Catatan/komentar berhasil dikirim.');
    }
}