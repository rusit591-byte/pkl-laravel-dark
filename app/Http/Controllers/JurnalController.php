<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    // Tampilkan daftar jurnal milik user yang login
    public function index()
    {
        $jurnals = Jurnal::where('user_id', Auth::id())->latest()->get();
        return view('jurnals.index', compact('jurnals'));
    }

    // Form tambah jurnal
    public function create()
    {
        return view('jurnals.create');
    }

    // Simpan data jurnal baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:todo,proses,selesai',
            'kendala' => 'nullable|string',
        ]);

        Jurnal::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'kendala' => $request->kendala,
        ]);

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    // Form edit jurnal
    public function edit(Jurnal $jurnal)
    {
        // Pastikan user hanya bisa edit miliknya sendiri
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }
        return view('jurnals.edit', compact('jurnal'));
    }

    // Update data jurnal
    public function update(Request $request, Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:todo,proses,selesai',
            'kendala' => 'nullable|string',
        ]);

        $jurnal->update($request->all());

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    // Hapus jurnal
    public function destroy(Jurnal $jurnal)
    {
        if ($jurnal->user_id !== Auth::id()) {
            abort(403);
        }

        $jurnal->delete();

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}