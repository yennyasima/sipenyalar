@extends('layouts.app')

@section('title', 'Edit Data Penyakit DBD')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.data-penyakit-dbd.index') }}">Data Penyakit DBD</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data Penyakit DBD</li>
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
                        <form action="{{ route('admin.data-penyakit-dbd.update', $dataPenyakitDbd->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Remark -->
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                    value="{{ $dataPenyakitDbd->remark }}" required>
                            </div>

                            <!-- Kelurahan -->
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                    value="{{ $dataPenyakitDbd->kelurahan }}" required>
                            </div>

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $dataPenyakitDbd->kecamatan }}" required>
                            </div>

                            <!-- Kasus -->
                            <div class="mb-3">
                                <label for="kasus" class="form-label">Kasus</label>
                                <input type="number" class="form-control" id="kasus" name="kasus"
                                    value="{{ $dataPenyakitDbd->kasus }}" required>
                            </div>

                            <!-- Tingkat Kasus -->
                            <div class="mb-3">
                                <label for="tingkat_ka" class="form-label">Tingkat Kasus</label>
                                <input type="text" class="form-control" id="tingkat_ka" name="tingkat_ka"
                                    value="{{ $dataPenyakitDbd->tingkat_ka }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $dataPenyakitDbd->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
