@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
    <div class="container-fluid">
        <!-- Display Error Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createKriteriaModal">
                    <i class='bx bx-user-plus'></i> Input Kriteria
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>KRITERIA</th>
                            <th>BOBOT (%)</th>
                            <th>AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kriterias as $kriteria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kriteria->nama_kriteria }}</td>
                                <td>{{ $kriteria->bobot_kriteria }}</td>
                                <td>
                                    <a href="{{ route('kriteria.edit', $kriteria->id_kriteria) }}" class="btn btn-warning">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id_kriteria) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Kriteria Modal -->
        <div class="modal fade" id="createKriteriaModal" tabindex="-1" role="dialog"
             aria-labelledby="createKriteriaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createKriteriaModalLabel">Tambah Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan Kriteria" name="nama_kriteria"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan Bobot Kriteria" name="bobot_kriteria"
                                       class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-info">
                                <i class='bx bx-plus'></i> Tambah Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
