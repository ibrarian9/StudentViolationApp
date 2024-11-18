<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'subkriteria'])->get();

        $siswa = Siswa::all();
        $kriteria = Kriteria::with('subkriteria')->get();

        return view('pelanggaran.index', compact('pelanggaran', 'siswa', 'kriteria'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            'subkriteria' => 'required|array',
        ]);

        foreach ($request->subkriteria as $subkriteriaId) {
            Pelanggaran::create([
                'id_siswa' => $validatedData['id_siswa'],
                'id_subkriteria' => $subkriteriaId
            ]);
        }

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Pelanggaran berhasil ditambahkan');
    }

    public function destroy(Pelanggaran $pelanggaran): RedirectResponse
    {
        $pelanggaran->delete();
        return redirect()->route('pelanggaran.index')
            ->with('success', 'Pelanggaran berhasil dihapus');
    }
}
