@extends('layouts.app')

@section('title', 'Proses SMART')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Proses SMART</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Normalisasi Bobot Kriteria</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="normalisasiTable">
                        <thead class="text-center">
                        <tr>
                            <th>NO</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Normalisasi Bobot</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @php $total = 0 @endphp
                        @foreach($kriteria as $index => $k)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $k->nama_kriteria }}</td>
                                <td>{{ $k->bobot_kriteria }}</td>
                                <td>{{ $k->normalisasi_bobot }}</td>
                            </tr>
                        @endforeach
                        <tr class="inverse">
                            <td colspan="2">Total</td>
                            <td>{{ $kriteria->sum('bobot_kriteria') }}</td>
                            <td>1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Kode Kriteria</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th>Kriteria</th>
                            <th>Sikap dan Perilaku</th>
                            <th>Kerajinan</th>
                            <th>Kerapian</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td>Kode Kriteria</td>
                            <td>K1</td>
                            <td>K2</td>
                            <td>K3</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Nilai Alternatif</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="alternatifTable">
                        <thead class="text-center">
                        <tr>
                            <th>NO</th>
                            <th>Nama Siswa</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($nilaiSiswa as $index => $alt)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $alt["nama_siswa"] }}</td>
                                <td>{{ $alt["total_k1"] }}</td>
                                <td>{{ $alt["total_k2"] }}</td>
                                <td>{{ $alt["total_k3"] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#normalisasiTable, #alternatifTable').DataTable();
        });
    </script>
@endpush
