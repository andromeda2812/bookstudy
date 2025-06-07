<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Ruang;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('ruang')->orderBy('tanggal', 'desc')->get();
        $ruangs = Ruang::all();

        return view('admin.maintenance.index', compact('maintenances', 'ruangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id' => 'required|exists:ruang,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data maintenance
        Maintenance::create([
            'ruang_id' => $request->ruang_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keterangan' => $request->keterangan,
        ]);

        // Update status ruang jadi 2 (maintenance)
        $ruang = Ruang::find($request->ruang_id);
        $ruang->status = 2;
        $ruang->save();

        return redirect()->route('admin.maintenance.index')->with('success', 'Jadwal maintenance berhasil ditambahkan dan status ruang diupdate.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Simpan id ruang sebelum hapus maintenance
        $ruang_id = $maintenance->ruang_id;

        $maintenance->delete();

        // Update status ruang jadi 1 (tersedia)
        $ruang = Ruang::find($ruang_id);
        $ruang->status = 1;
        $ruang->save();

        return redirect()->route('admin.maintenance.index')->with('success', 'Jadwal maintenance berhasil dihapus dan status ruang diupdate.');
    }

    public function detail($ruangId)
{
    // Ambil maintenance terbaru untuk ruang ini
    $maintenance = Maintenance::where('ruang_id', $ruangId)
        ->latest('tanggal')
        ->first();

    if (!$maintenance) {
        return response()->json(['message' => 'Data maintenance tidak ditemukan'], 404);
    }

    return response()->json($maintenance);
}


}
