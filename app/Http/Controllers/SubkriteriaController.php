<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $subkriterias = SubKriteria::with('kriteria')
            ->orderBy('bobot_subkriteria')
            ->get();
        $kriterias = Kriteria::all();
        return view('subkriteria.index', compact('subkriterias', 'kriterias'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_kriteria' => 'required|exists:tb_kriteria,id_kriteria',
            'nama_subkriteria' => 'required|string',
            'bobot_subkriteria' => 'required|numeric'
        ]);

        SubKriteria::create($validatedData);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $kriterias = Kriteria::all();
        return view('subkriteria.edit', compact('subkriteria', 'kriterias'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_kriteria' => 'required|exists:tb_kriteria,id_kriteria',
            'nama_subkriteria' => 'required|string',
            'bobot_subkriteria' => 'required|numeric'
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update($validatedData);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil diupdate');
    }

    public function destroy($id): RedirectResponse
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil dihapus');
    }
}
