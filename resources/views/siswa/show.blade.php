@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Siswa</h3>
    <table class="table table-bordered">
        <tr>
            <th>NISN</th>
            <td>{{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $siswa->kelas }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $siswa->jk_siswa }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $siswa->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $siswa->tgl_lahir->toDateString() }}</td>
        </tr>
        <tr>
            <th>Nama Ayah</th>
            <td>{{ $siswa->nama_ayah }}</td>
        </tr>
        <tr>
            <th>Nama Ibu</th>
            <td>{{ $siswa->nama_ibu }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $siswa->alamat }}</td>
        </tr>
        <tr>
            <th>Nomor HP Wali/Orang Tua</th>
            <td>{{ $siswa->nohp_ortu }}</td>
        </tr>
    </table>
    <div class="card-body">
        <h3>Riwayat Pelanggaran Siswa</h3>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>NO</th>
                    <th>PELANGGARAN</th>
                    <th>POIN</th>
                    <th>TANGGAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataPelanggaran as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->subkriteria->nama_subkriteria }}</td>
                        <td>{{ $data->subkriteria->bobot_subkriteria }}</td>
                        <td>{{ $data->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Total Score</strong></td>
                        <td colspan="2">{{ $totalScore ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Sanksi</strong></td>
                        <td colspan="2">{{ $sanksi ?? "-" }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
