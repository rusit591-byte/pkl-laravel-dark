<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    /**
     * Tampilkan daftar jurnal dengan pencarian, filter, dan pagination.
     */
    public function index(Request $request)
    {
        $query = Jurnal::with(['kategori', 'user'])
            ->where('user_id', Auth::id());

        // 1. Fitur Pencarian berdasarkan Judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 2. Filter berdasarkan Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // 3. Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. Filter berdasarkan Tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Ambil data dengan pagination dan pastikan filter terbawa saat pindah halaman
        $jurnals = $query->latest('tanggal')->paginate(5)->withQueryString();
        
        // Ambil data kategori untuk opsi filter di dropdown view
        $kategoris = Kategori::all();

        return view('jurnals.index', compact('jurnals', 'kategoris'));
    }

    /**
     * Tampilkan form tambah jurnal.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('jurnals.create', compact('kategoris'));
    }

    /**
     * Simpan jurnal baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'   => 'required|string',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:Proses,Selesai,Revisi',
            'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file max 2MB
        ]);

        $data = $request->except('lampiran');
        $data['user_id'] = Auth::id();

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampirans', 'public');
        }

        Jurnal::create($data);

        return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit jurnal.
     */
    public function edit(Jurnal $jurnal)
    {
        // Pastikan hanya pemilik jurnal yang bisa edit
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $kategoris = Kategori::all();
        return view('jurnals.edit', compact('jurnal', 'kategoris'));
    }

    /**
     * Update jurnal.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'   => 'required|string',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:Proses,Selesai,Revisi',
            'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->except('lampiran');

        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada
            if ($jurnal->lampiran && Storage::disk('public')->exists($jurnal->lampiran)) {
                Storage::disk('public')->delete($jurnal->lampiran);
            }
            $data['lampiran'] = $request->file('lampiran')->store('lampirans', 'public');
        }

        $jurnal->update($data);

        return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil diperbarui.');
    }

    /**
     * Hapus jurnal.
     */
    public function destroy(Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        if ($jurnal->lampiran && Storage::disk('public')->exists($jurnal->lampiran)) {
            Storage::disk('public')->delete($jurnal->lampiran);
        }

        $jurnal->delete();
        <?php

        namespace App\Http\Controllers;
        
        use App\Models\Jurnal;
        use App\Models\Kategori;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
        
        class JurnalController extends Controller
        {
            public function index(Request $request)
            {
                $user = Auth::user();
        
                // Ambil jurnal milik siswa yang sedang login saja
                $query = Jurnal::where('user_id', $user->id)->with(['kategori', 'komentars.user']);
        
                // Filter pencarian judul
                if ($request->filled('search')) {
                    $query->where('judul', 'like', '%' . $request->search . '%');
                }
        
                // Filter kategori
                if ($request->filled('kategori_id')) {
                    $query->where('kategori_id', $request->kategori_id);
                }
        
                // Filter status
                if ($request->filled('status')) {
                    $query->where('status', $request->status);
                }
        
                // Filter tanggal
                if ($request->filled('tanggal')) {
                    $query->where('tanggal', $request->tanggal);
                }
        
                $jurnals = $query->latest('tanggal')->paginate(5)->withQueryString();
                $kategoris = Kategori::all();
        
                return view('jurnals.index', compact('jurnals', 'kategoris'));
            }
        
            public function create()
            {
                $kategoris = Kategori::all();
                return view('jurnals.create', compact('kategoris'));
            }
        
            public function store(Request $request)
            {
                $request->validate([
                    'tanggal'     => 'required|date',
                    'judul'       => 'required|string|max:255',
                    'kategori_id' => 'required|exists:kategoris,id',
                    'deskripsi'   => 'required|string',
                    'lampiran'    => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
                ]);
        
                $path = null;
                if ($request->hasFile('lampiran')) {
                    $path = $request->file('lampiran')->store('lampirans', 'public');
                }
        
                Jurnal::create([
                    'user_id'     => Auth::id(),
                    'tanggal'     => $request->tanggal,
                    'judul'       => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'deskripsi'   => $request->deskripsi,
                    'lampiran'    => $path,
                    'status'      => 'proses',
                ]);
        
                return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil ditambahkan.');
            }
        
            public function edit(Jurnal $jurnal)
            {
                // Pastikan hanya pemilik jurnal yang bisa mengedit
                if ($jurnal->user_id !== Auth::id()) {
                    abort(403);
                }
        
                $kategoris = Kategori::all();
                return view('jurnals.edit', compact('jurnal', 'kategoris'));
            }
        
            public function update(Request $request, Jurnal $jurnal)
            {
                if ($jurnal->user_id !== Auth::id()) {
                    abort(403);
                }
        
                $request->validate([
                    'tanggal'     => 'required|date',
                    'judul'       => 'required|string|max:255',
                    'kategori_id' => 'required|exists:kategoris,id',
                    'deskripsi'   => 'required|string',
                    'lampiran'    => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
                ]);
        
                $path = $jurnal->lampiran;
                if ($request->hasFile('lampiran')) {
                    $path = $request->file('lampiran')->store('lampirans', 'public');
                }
        
                $jurnal->update([
                    'tanggal'     => $request->tanggal,
                    'judul'       => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'deskripsi'   => $request->deskripsi,
                    'lampiran'    => $path,
                ]);
        
                return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil diperbarui.');
            }
        
            public function destroy(Jurnal $jurnal)
            {
                if ($jurnal->user_id !== Auth::id()) {
                    abort(403);
                }
        
                $jurnal->delete();
        
                return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil dihapus.');
            }
        }
        return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil dihapus.');
    }
}