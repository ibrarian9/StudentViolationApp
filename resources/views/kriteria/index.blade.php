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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
