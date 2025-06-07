<?php

namespace App\Http\Controllers\Admin; // <-- Pastikan namespace sesuai folder

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::orderBy('created_at', 'desc')->get();
        return view('admin.ruangan.index', compact('ruangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048', // max 2MB
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('ruang', 'public');
            $validated['foto'] = $path;
        }

        Ruang::create($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function update(Request $request, Ruang $ruang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($ruang->foto && Storage::disk('public')->exists($ruang->foto)) {
                Storage::disk('public')->delete($ruang->foto);
            }
            $path = $request->file('foto')->store('ruang', 'public');
            $validated['foto'] = $path;
        }

        $ruang->update($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        if ($ruang->foto && Storage::disk('public')->exists($ruang->foto)) {
            Storage::disk('public')->delete($ruang->foto);
        }

        $ruang->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
