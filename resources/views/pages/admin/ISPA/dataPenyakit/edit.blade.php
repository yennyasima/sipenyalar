@extends('layouts.app')

@section('title', 'Edit Data Penyakit ISPA')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.data-penyakit-ispa.index') }}">Data Penyakit ISPA</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data Penyakit ISPA</li>
            </ol>
        </nav>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.data-penyakit-ispa.update', $dataPenyakitIspa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $dataPenyakitIspa->kecamatan }}" required>
                            </div>

                            <!-- Luas Kecamatan -->
                            <div class="mb-3">
                                <label for="luas_kec" class="form-label">Luas Kecamatan</label>
                                <input type="text" class="form-control" id="luas_kec" name="luas_kec"
                                    value="{{ $dataPenyakitIspa->luas_kec }}" required>
                            </div>

                            <!-- Puskesmas -->
                            <div class="mb-3">
                                <label for="puskesmas" class="form-label">Puskesmas</label>
                                <input type="text" class="form-control" id="puskesmas" name="puskesmas"
                                    value="{{ $dataPenyakitIspa->puskesmas }}" required>
                            </div>

                            <!-- Kasus -->
                            <div class="mb-3">
                                <label for="jumlah_balita" class="form-label">Jumlah Balita</label>
                                <input type="number" class="form-control" id="jumlah_balita" name="jumlah_balita"
                                    value="{{ $dataPenyakitIspa->jumlah_balita }}" required>
                            </div>

                            <!-- jumlah ispa penderita -->
                            <div class="mb-3">
                                <label for="jumlah_ispa_penderita" class="form-label">Jumlah Ispa Penderita</label>
                                <input type="text" class="form-control" id="jumlah_ispa_penderita"
                                    name="jumlah_ispa_penderita" value="{{ $dataPenyakitIspa->jumlah_ispa_penderita }}"
                                    required>
                            </div>

                            <!-- nilai_range -->
                            <div class="mb-3">
                                <label for="nilai_range" class="form-label">Nilai Range</label>
                                <input type="text" class="form-control" id="nilai_range" name="nilai_range"
                                    value="{{ $dataPenyakitIspa->nilai_range }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $dataPenyakitIspa->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $dataPenyakitIspa->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
