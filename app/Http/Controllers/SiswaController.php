<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('pelanggaran.subkriteria')->get();
        return view('siswa.index', compact('siswa'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'kelas' => 'required',
                'nama_siswa' => 'required|string|max:50',
                'nisn' => 'required|string|max:20|unique:tb_siswa,nisn',
                'jk_siswa' => 'required|in:Laki-Laki,Perempuan',
                'tempat_lahir' => 'required|string|max:50',
                'tgl_lahir' => 'required|date',
                'nama_ayah' => 'required|string|max:50',
                'nama_ibu' => 'required|string|max:50',
                'alamat' => 'required|string|max:200',
                'nohp_ortu' => 'required|string|max:13'
            ]);

            Siswa::create($validated);
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $validated = $request->validate([
            'kelas' => 'required',
            'nama_siswa' => 'required|string|max:50',
            'nisn' => 'required|string|max:20|unique:tb_siswa,nisn,'.$siswa->id_siswa.',id_siswa',
            'jk_siswa' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'nama_ayah' => 'required|string|max:50',
            'nama_ibu' => 'required|string|max:50',
            'alamat' => 'required|string|max:200',
            'nohp_ortu' => 'required|string|max:13'
        ]);

        $siswa->update($validated);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function show(Siswa $siswa){
        $dataPelanggaran = Pelanggaran::with(['siswa', 'subkriteria'])->where('id_siswa', '=', $siswa->id_siswa)->get();
        return view('siswa.show', compact('siswa', 'dataPelanggaran'));
    }
}
