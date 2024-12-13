@extends('layouts.app')

@section('title', 'Sub Kriteria')

@section('content')
    <div class="container-fluid">
        <!-- Error and Success Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sub Kriteria</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createSubKriteriaModal">
                    <i class='bx bx-user-plus'></i> Input Sub Kriteria
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>KRITERIA</th>
                            <th>SUBKRITERIA</th>
                            <th>POINT</th>
                            <th>AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subkriterias as $subkriteria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subkriteria->kriteria->nama_kriteria }}</td>
                                <td>{{ $subkriteria->nama_subkriteria }}</td>
                                <td>{{ $subkriteria->bobot_subkriteria }}</td>
                                <td>
                                    <a href="{{ route('subkriteria.edit', $subkriteria->id_subkriteria) }}"
                                       class="btn btn-warning">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <form action="{{ route('subkriteria.destroy', $subkriteria->id_subkriteria) }}"
                                          method="POST" class="d-inline">
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

        <!-- Create Sub Kriteria Modal -->
        <div class="modal fade" id="createSubKriteriaModal" tabindex="-1" role="dialog"
             aria-labelledby="createSubKriteriaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSubKriteriaModalLabel">Tambah Sub Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('subkriteria.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <select name="id_kriteria" class="form-control" required>
                                    <option value="">Pilih kriteria...</option>
                                    @foreach($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}">
                                            {{ $kriteria->nama_kriteria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan Sub Kriteria"
                                       name="nama_subkriteria" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" placeholder="Masukkan Bobot Sub Kriteria"
                                       name="bobot_subkriteria" class="form-control" required>
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
