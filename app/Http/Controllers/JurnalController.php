<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $jurnals = Jurnal::where('user_id', $user->id)
            ->with(['kategori', 'komentars.user'])
            ->filter($request->only(['search', 'kategori_id', 'status', 'tanggal']))
            ->latest('tanggal')
            ->paginate(5)
            ->withQueryString();

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
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
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

        if ($jurnal->lampiran && Storage::disk('public')->exists($jurnal->lampiran)) {
            Storage::disk('public')->delete($jurnal->lampiran);
        }

        $jurnal->delete();

        return redirect()->route('jurnals.index')->with('success', 'Jurnal harian berhasil dihapus.');
    }
}