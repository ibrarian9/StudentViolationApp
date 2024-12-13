@extends('layouts.app')

@section('title', 'Edit Sub Kriteria')

@section('content')
<div class="container-fluid">
    <!-- Error and Success Messages -->
    @include('layouts.partials.messages')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Sub Kriteria</h1>
    </div>

    <form action="{{ route('subkriteria.update', $subkriteria->id_subkriteria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="id_kriteria">Kriteria</label>
                    <select name="id_kriteria" id="id_kriteria" class="form-control" required>
                        <option value="">kriteria...</option>
                        @foreach($kriterias as $kriteria)
                            <option value="{{ $kriteria->id_kriteria }}"
                                {{ $subkriteria->id_kriteria == $kriteria->id_kriteria ? 'selected' : '' }}>
                                {{ $kriteria->nama_kriteria }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_subkriteria">Sub Kriteria</label>
                    <textarea name="nama_subkriteria" id="nama_subkriteria"
              class="form-control" rows="4" required>{{ $subkriteria->nama_subkriteria }}</textarea>
                </div>
                <div class="form-group">
                    <label for="bobot_subkriteria">Point</label>
                    <input type="number" name="bobot_subkriteria" id="bobot_subkriteria"
                           class="form-control" value="{{ $subkriteria->bobot_subkriteria }}" required>
                </div>
                <button type="submit" class="btn btn-info">
                    <i class='bx bx-save'></i> Simpan Perubahan
                </button>
                <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary">
                    <i class='bx bx-arrow-back'></i> Kembali
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
