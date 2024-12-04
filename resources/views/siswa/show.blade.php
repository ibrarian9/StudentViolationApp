@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Siswa</h1>
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
            <td>{{ $siswa->tgl_lahir }}</td>
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
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
