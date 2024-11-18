@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SISWA</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswaCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bxs-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">KRITERIA</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteriaCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bxs-category-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">SUBKRITERIA</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subkriteriaCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bxs-category-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PELANGGARAN</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pelanggaranCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-spreadsheet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
