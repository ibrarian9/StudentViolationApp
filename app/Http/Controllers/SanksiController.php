<?php

namespace App\Http\Controllers;

use App\Models\Sanksi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SanksiController extends Controller
{
    public function index()
    {
        $sanksi = Sanksi::all();
        return view("sanksi.index", compact("sanksi"));
    }

    public function edit(Sanksi $sanksi)
    {
        return view("sanksi.edit", compact('sanksi'));
    }

    public function update(Request $request, Sanksi $sanksi): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'jumlah_poin' => 'required',
                'jenis_sanksi' => 'required|string|max:100',
            ]);

            $sanksi->update($validated);
            return redirect()->route('sanksi.index')->with('success', 'Data Sanksi berhasil diupdate');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'jumlah_poin' => 'required',
                'jenis_sanksi' => 'required|string|max:100',
            ]);

            Sanksi::create($validated);
            return redirect()->route('sanksi.index')->with('success', 'Data Sanksi berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Sanksi $sanksi): RedirectResponse
    {
        $sanksi->delete();
        return redirect()->route('sanksi.index')->with('success', 'Data Sanksi berhasil dihapus');
    }
}
