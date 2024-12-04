@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <div class="container-fluid">
        <!-- Display Error Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Kriteria</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3">
                        <input type="text"
                               value=""
                               name="nama_kriteria"
                               placeholder="Masukkan Nama Kriteria"
                               class="form-control @error('nama_kriteria') is-invalid @enderror"
                               required>
                        @error('nama_kriteria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text"
                               value=""
                               name="bobot_kriteria"
                               placeholder="Masukkan Bobot Kriteria"
                               class="form-control @error('bobot_kriteria') is-invalid @enderror"
                               required>
                        @error('bobot_kriteria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-info">
                        <i class='bx bx-save'></i> Update Data
                    </button>

                    <a href="" class="btn btn-secondary">
                        <i class='bx bxs-share'></i>
                        <span class="text">Back</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
