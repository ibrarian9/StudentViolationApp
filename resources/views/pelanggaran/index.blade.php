@extends('layouts.app')

@section('title', 'Data Pelanggaran')

@section('content')
    <div class="container-fluid">
        <!-- Display Error Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pelanggaran</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inputPelanggaranModal">
                    <i class='bx bx-user-plus'></i> Input Pelanggaran
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NISN</th>
                            <th>KELAS</th>
                            <th>SISWA</th>
                            <th>PELANGGARAN</th>
                            <th>BOBOT</th>
                            <th>AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pelanggaran as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->siswa->nisn }}</td>
                                <td>{{ $p->siswa->kelas }}</td>
                                <td>{{ $p->siswa->nama_siswa }}</td>
                                <td>{{ $p->subkriteria->nama_subkriteria }}</td>
                                <td>{{ $p->subkriteria->bobot_subkriteria }}</td>
                                <td>
                                    <form action="{{ route('pelanggaran.destroy', $p->id_pelanggaran) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus pelanggaran?')">
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

        <!-- Input Pelanggaran Modal -->
        <div class="modal fade" id="inputPelanggaranModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Pelanggaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pelanggaran.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <select name="id_siswa" class="form-control" required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach($siswa as $s)
                                        <option value="{{ $s->id_siswa }}">{{ $s->nama_siswa }} - {{ $s->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach($kriteria as $k)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                               href="#kriteria-{{ $k->id_kriteria }}"
                                               data-toggle="tab">
                                                {{ $k->nama_kriteria }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="nav-item">
                                        <a class="nav-link" href="#selesai" data-toggle="tab">Selesai</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    @foreach($kriteria as $k)
                                        <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                             id="kriteria-{{ $k->id_kriteria }}">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>BENTUK PELANGGARAN</th>
                                                    <th>BOBOT</th>
                                                    <th>PILIH</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($k->subkriteria as $subkriteria)
                                                    <tr>
                                                        <td>{{ $subkriteria->nama_subkriteria }}</td>
                                                        <td>{{ $subkriteria->bobot_subkriteria }}</td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   name="subkriteria[]"
                                                                   value="{{ $subkriteria->id_subkriteria }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                    <div class="tab-pane" id="selesai">
                                        <p>Pastikan Anda Telah Memilih Pelanggaran Yang Dilakukan Siswa</p>
                                        <button type="submit" class="btn btn-success">
                                            Selesaikan <i class="bx bx-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
