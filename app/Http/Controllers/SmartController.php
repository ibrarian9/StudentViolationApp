<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pelanggaran;
use App\Models\Sanksi;

class SmartController extends Controller
{
    public function index(){
        // Get total bobot
        $totalBobot = Kriteria::sum('bobot_kriteria');

        // Get kriteria with normalized weights
        $kriteria = Kriteria::get()->map(function($item) use ($totalBobot) {
            $item->normalisasi_bobot = $item->getNormalisasiBobot($totalBobot);
            return $item;
        });

        // Step 1: Fetch all violations with subcriteria and criteria relationships
        $pelanggaran = Pelanggaran::with('subkriteria.kriteria', 'siswa')->get();

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

        foreach ($nilaiSiswa as &$item){
            $matchingSanksi = $sanksi->sortByDesc('jumlah_poin')
                ->firstWhere('jumlah_poin', '<=', $item['total_score']);

            $item['sanksi'] = $matchingSanksi ? $matchingSanksi->jenis_sanksi : '-';
        }

        return view('proses-smart.index', compact('kriteria', 'nilaiSiswa'));
    }
}
