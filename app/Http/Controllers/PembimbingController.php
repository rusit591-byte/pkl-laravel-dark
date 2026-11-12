<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua jurnal beserta relasinya
        $query = Jurnal::with(['user', 'kategori', 'komentars.user']);

        // Filter jika pembimbing memilih siswa tertentu
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $jurnals = $query->latest('tanggal')->paginate(10)->withQueryString();
        
        // Ambil data peserta (gunakan pengaman jika kolom role berbeda)
        $pesertas = User::where('role', 'peserta')->orWhere('role', 'siswa')->get();

        return view('pembimbing.jurnals.index', compact('jurnals', 'pesertas'));
    }

    public function storeKomentar(Request $request, Jurnal $jurnal)
    {
        $request->validate(['isi' => 'required|string']);

        Komentar::create([
            'jurnal_id' => $jurnal->id,
            'user_id'   => Auth::id(),
            'isi'       => $request->isi,
        ]);

        return back()->with('success', 'Catatan evaluasi berhasil dikirim.');
    }

    public function updateStatus(Request $request, Jurnal $jurnal)
    {
        $request->validate(['status' => 'required|string']);

        $jurnal->update(['status' => $request->status]);

        return back()->with('success', 'Status jurnal berhasil diperbarui.');
    }
}