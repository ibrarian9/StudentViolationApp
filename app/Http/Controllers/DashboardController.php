<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'siswaCount' => Siswa::count(),
            'kriteriaCount' => Kriteria::count(),
            'subkriteriaCount' => Subkriteria::count(),
            'pelanggaranCount' => Pelanggaran::count(),
        ]);
    }
}
