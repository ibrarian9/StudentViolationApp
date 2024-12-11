@extends('layouts.app')

@section('title', 'Edit Data Sanksi')

@section('content')
    <div class="container">
        <h1>Edit Data Sanksi</h1>

        <form action="{{ route('sanksi.update', $sanksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jumlah_poin">Jumlah Poin</label>
                <input type="number" name="jumlah_poin" id="jumlah_poin" class="form-control" value="{{ old('jumlah_poin', $sanksi->jumlah_poin) }}" required>
            </div>

            <div class="form-group">
                <label for="jenis_sanksi">Jenis Sanksi</label>
                <input type="text" name="jenis_sanksi" id="jenis_sanksi" class="form-control" value="{{ old('jenis_sanksi', $sanksi->jenis_sanksi) }}" required>
            </div>

            <button type="submit" class="btn btn-info">Simpan</button>
            <a href="{{ route('sanksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
