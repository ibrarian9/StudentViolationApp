<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Subkriteria;

class DashboardController extends Controller
{
    public function index()
    {
        $topSubkriteria = Subkriteria::withCount('pelanggaran')
            ->orderBy('pelanggaran_count', 'DESC')
            ->take(5)
            ->get();

        // Step 1: Fetch all violations with subcriteria and criteria relationships
        $pelanggaran = Pelanggaran::with('subkriteria.kriteria', 'siswa')->get();

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
                    'nama_siswa' => $nama_siswa,
                    'total_k1' => 0,
                    'total_k2' => 0,
                    'total_k3' => 0,
                    'total_score' => 0,
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

        // Step 3: Sort students by total_score in descending order
        usort($nilaiSiswa, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        // Step 4: Limit results to top 5
        $topSiswa = array_slice($nilaiSiswa, 0, 5);

        return view('dashboard', [
            'siswaCount' => Siswa::count(),
            'kriteriaCount' => Kriteria::count(),
            'subkriteriaCount' => Subkriteria::count(),
            'pelanggaranCount' => Pelanggaran::count(),
            'topPelanggaran' => $topSubkriteria,
            'listSiswa' => $topSiswa
        ]);
    }
}
