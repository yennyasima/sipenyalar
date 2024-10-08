@extends('layouts.app')

@section('title', 'Edit Kepadatan Penduduk DBD')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.data-penyakit-dbd.index') }}">Kepadatan Penduduk DBD</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Kepadatan Penduduk DBD</li>
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
                        <form action="{{ route('admin.faktor-lingkungan-dbd.update', $faktorLingkunganDbd->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Remark -->
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                    value="{{ $faktorLingkunganDbd->remark }}" required>
                            </div>

                            <!-- Kelurahan -->
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                    value="{{ $faktorLingkunganDbd->kelurahan }}" required>
                            </div>

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $faktorLingkunganDbd->kecamatan }}" required>
                            </div>

                            <!-- Curah Hujan -->
                            <div class="mb-3">
                                <label for="curah_hujan" class="form-label">Curah Hujan</label>
                                <input type="number" class="form-control" id="curah_hujan" name="curah_hujan"
                                    value="{{ $faktorLingkunganDbd->curah_hujan }}" required>
                            </div>

                            <!-- Kelembapan -->
                            <div class="mb-3">
                                <label for="kelembapan" class="form-label">Kelembapan</label>
                                <input type="number" class="form-control" id="kelembapan" name="kelembapan"
                                    value="{{ $faktorLingkunganDbd->kelembapan }}" required>
                            </div>

                            <!-- suhu -->
                            <div class="mb-3">
                                <label for="suhu" class="form-label">Suhu</label>
                                <input type="number" class="form-control" id="suhu" name="suhu"
                                    value="{{ $faktorLingkunganDbd->suhu }}" required>
                            </div>

                            <!-- tingkat_ka_suhu -->
                            <div class="mb-3">
                                <label for="tingkat_ka_suhu" class="form-label">Tingkat Kasus Suhu</label>
                                <input type="text" class="form-control" id="tingkat_ka_suhu" name="tingkat_ka_suhu"
                                    value="{{ $faktorLingkunganDbd->tingkat_ka_suhu }}" required>
                            </div>

                            <!-- tingkat_ka_curah_hujan -->
                            <div class="mb-3">
                                <label for="tingkat_ka_curah_hujan" class="form-label">Tingkat Kasus Curah hujan</label>
                                <input type="text" class="form-control" id="tingkat_ka_curah_hujan"
                                    name="tingkat_ka_curah_hujan"
                                    value="{{ $faktorLingkunganDbd->tingkat_ka_curah_hujan }}" required>
                            </div>

                            <!-- tingkat_ka_kelembaban -->
                            <div class="mb-3">
                                <label for="tingkat_ka_kelembapan" class="form-label">Tingkat Kasus Kelembapan</label>
                                <input type="text" class="form-control" id="tingkat_ka_kelembapan"
                                    name="tingkat_ka_kelembapan" value="{{ $faktorLingkunganDbd->tingkat_ka_kelembapan }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $faktorLingkunganDbd->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
