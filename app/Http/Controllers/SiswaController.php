<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Sanksi;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiswaController extends Controller
{
    public function index(): Application|Factory|View
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

    public function edit(Siswa $siswa): Application|Factory|View
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

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $pelanggaran = Pelanggaran::where('id_siswa', $siswa->id_siswa);
        $pelanggaran->delete();
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function show(Siswa $siswa){
        $dataPelanggaran = Pelanggaran::with(['siswa', 'subkriteria'])->where('id_siswa', $siswa->id_siswa)->get();

        $pelanggaran = Pelanggaran::with('subkriteria.kriteria', 'siswa')->where('id_siswa', $siswa->id_siswa)->get();

        $sanksi = Sanksi::all();

        // Step 2: Initialize student scores grouped by criteria
        $nilaiSiswa = [];

        foreach ($pelanggaran as $violation) {
            $siswa = $violation->siswa;
            $id_siswa = $siswa->id_siswa;
            $nama_siswa = $siswa->nama_siswa;

            $subkriteria = $violation->subkriteria;
            $id_kriteria = $subkriteria->id_kriteria;
            $bobot_subkriteria = $subkriteria->bobot_subkriteria;

            // Initialize student data if not already set
            if (!isset($nilaiSiswa[$id_siswa])) {
                $nilaiSiswa[$id_siswa] = [
                    'id_siswa' => $id_siswa,
                    'nama_siswa' => $nama_siswa,
                    'total_k1' => 0,
                    'total_k2' => 0,
                    'total_k3' => 0,
                    'total_score' => 0,
                    'sanksi' => '-'
                ];
            }

            // Accumulate subcriteria scores based on criteria
            if ($id_kriteria == 3) {
                $nilaiSiswa[$id_siswa]['total_k1'] += $bobot_subkriteria;
            } elseif ($id_kriteria == 4) {
                $nilaiSiswa[$id_siswa]['total_k2'] += $bobot_subkriteria;
            } elseif ($id_kriteria == 6) {
                $nilaiSiswa[$id_siswa]['total_k3'] += $bobot_subkriteria;
            }

            // Calculate total score by summing all weighted criteria scores
            $nilaiSiswa[$id_siswa]['total_score'] =
                ($nilaiSiswa[$id_siswa]['total_k1'] * 0.5) +
                ($nilaiSiswa[$id_siswa]['total_k2'] * 0.2) +
                ($nilaiSiswa[$id_siswa]['total_k3'] * 0.3);
        }

        foreach ($nilaiSiswa as &$item) {
            $matchingSanksi = $sanksi->sortByDesc('jumlah_poin')
                ->firstWhere('jumlah_poin', '<=', $item['total_score']);

            $item['sanksi'] = $matchingSanksi ? $matchingSanksi->jenis_sanksi : '-';
        }

        // Get Total Score and Sanksi for a specific id_siswa
        $id_siswa_to_check = $siswa->id_siswa; // The specific id_siswa being checked
        $totalScoreAndSanksi = $nilaiSiswa[$id_siswa_to_check] ?? null;

        if ($totalScoreAndSanksi) {
            $totalScore = $totalScoreAndSanksi['total_score'];
            $sanksi = $totalScoreAndSanksi['sanksi'];

            // Pass the total score and sanksi to the view
            return view('siswa.show', compact('siswa', 'dataPelanggaran', 'totalScore', 'sanksi'));
        } else {
            // Handle case where no data is found for the student
            return view('siswa.show', compact('siswa', 'dataPelanggaran'))
                ->with('message', 'No data found for this siswa');
        }
    }

    public function downloadPdf(Siswa $siswa): Response
    {
        // Fetch the necessary data for the PDF
        $dataPelanggaran = Pelanggaran::with(['siswa', 'subkriteria'])
            ->where('id_siswa', $siswa->id_siswa)
            ->get();

        $pelanggaran = Pelanggaran::with('subkriteria.kriteria', 'siswa')
            ->where('id_siswa', $siswa->id_siswa)
                ->get();

        $sanksi = Sanksi::all();
        $nilaiSiswa = [];

        foreach ($pelanggaran as $violation) {
            $id_siswa = $violation->siswa->id_siswa;
            $nama_siswa = $violation->siswa->nama_siswa;

            $subkriteria = $violation->subkriteria;
            $id_kriteria = $subkriteria->id_kriteria;
            $bobot_subkriteria = $subkriteria->bobot_subkriteria;

            if (!isset($nilaiSiswa[$id_siswa])) {
                $nilaiSiswa[$id_siswa] = [
                    'id_siswa' => $id_siswa,
                    'nama_siswa' => $nama_siswa,
                    'total_k1' => 0,
                    'total_k2' => 0,
                    'total_k3' => 0,
                    'total_score' => 0,
                    'sanksi' => '-'
                ];
            }

            if ($id_kriteria == 3) {
                $nilaiSiswa[$id_siswa]['total_k1'] += $bobot_subkriteria;
            } elseif ($id_kriteria == 4) {
                $nilaiSiswa[$id_siswa]['total_k2'] += $bobot_subkriteria;
            } elseif ($id_kriteria == 6) {
                $nilaiSiswa[$id_siswa]['total_k3'] += $bobot_subkriteria;
            }

            $nilaiSiswa[$id_siswa]['total_score'] =
                ($nilaiSiswa[$id_siswa]['total_k1'] * 0.5) +
                ($nilaiSiswa[$id_siswa]['total_k2'] * 0.2) +
                ($nilaiSiswa[$id_siswa]['total_k3'] * 0.3);
        }

        foreach ($nilaiSiswa as &$item) {
            $matchingSanksi = $sanksi->sortByDesc('jumlah_poin')
                ->firstWhere('jumlah_poin', '<=', $item['total_score']);
            $item['sanksi'] = $matchingSanksi ? $matchingSanksi->jenis_sanksi : '-';
        }

        $totalScoreAndSanksi = $nilaiSiswa[$siswa->id_siswa] ?? null;

        $totalScore = $totalScoreAndSanksi['total_score'] ?? 0;
        $sanksi = $totalScoreAndSanksi['sanksi'] ?? '-';

        // Load the PDF view with data
        $pdf = Pdf::loadView('siswa.pdf', compact('siswa', 'dataPelanggaran', 'totalScore', 'sanksi'));

        // Return the PDF for download
        return $pdf->download('riwayat_siswa.pdf');
    }
}
