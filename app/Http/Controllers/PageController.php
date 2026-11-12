<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        // Jika user sudah login, langsung ambil data dashboard
        if (Auth::check()) {
            $user = Auth::user();
            $query = Jurnal::query();

            if ($user->role === 'peserta') {
                $query->where('user_id', $user->id);
            }

            $totalJurnal = (clone $query)->count();
            $statusCounts = (clone $query)
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            $kategoriCounts = (clone $query)
                ->select('kategori_id', DB::raw('count(*) as total'))
                ->with('kategori')
                ->groupBy('kategori_id')
                ->get();

            $jurnal7Hari = (clone $query)
                ->where('tanggal', '>=', now()->subDays(7)->toDateString())
                ->count();

            // Tampilkan view dashboard langsung di beranda
            return view('dashboard.index', compact('totalJurnal', 'statusCounts', 'kategoriCounts', 'jurnal7Hari'));
        }

        // Jika belum login, tampilkan halaman landing biasa
        return view('home');
    }

    public function about() { return view('about'); }
    public function contact() { return view('contact'); }
}