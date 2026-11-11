<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Jurnal::query();

        // Jika peserta, batasi hanya data miliknya sendiri. Jika pembimbing, ambil semua data[cite: 2].
        if ($user->role === 'peserta') {
            $query->where('user_id', $user->id);
        }

        // 1. Total Jurnal[cite: 2]
        $totalJurnal = (clone $query)->count();

        // 2. Jumlah per Status (Agregasi groupBy)[cite: 2]
        $statusCounts = (clone $query)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // 3. Jumlah per Kategori[cite: 2]
        $kategoriCounts = (clone $query)
            ->select('kategori_id', DB::raw('count(*) as total'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->get();

        // 4. Jurnal 7 Hari Terakhir[cite: 2]
        $jurnal7Hari = (clone $query)
            ->where('tanggal', '>=', now()->subDays(7)->toDateString())
            ->count();

        return view('dashboard.index', compact('totalJurnal', 'statusCounts', 'kategoriCounts', 'jurnal7Hari'));
    }
}