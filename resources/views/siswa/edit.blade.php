@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="container">
    <h1>Edit Data Siswa</h1>

    <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
        </div>

        <div class="form-group">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" class="form-control" value="{{ old('nisn', $siswa->nisn) }}" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control" required>
                @php
                    $kelasList = ['7A', '7B', '8A', '8B', '9A', '9B'];
                @endphp
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ $siswa->kelas == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jk_siswa">Jenis Kelamin</label>
            <select name="jk_siswa" id="jk_siswa" class="form-control" required>
                <option value="Laki-Laki" {{ $siswa->jk_siswa == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ $siswa->jk_siswa == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tml_siswa">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="editTempatLahir" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tgl_siswa">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="editTanggalLahir" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ayah_siswa">Nama Ayah</label>
            <input type="text" name="nama_ayah" id="editNamaAyah" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ibu_siswa">Nama Ibu</label>
            <input type="text" name="nama_ibu" id="editNamaIbu" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="alamat_siswa">Alamat Siswa</label>
            <input type="text" name="alamat" id="editAlamat" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nohp_siswa">Nomor Wali/Orang Tua</label>
            <input type="text" name="nohp_ortu" id="editNohpOrtu" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
