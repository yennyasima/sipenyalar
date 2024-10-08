@extends('layouts.app')

@section('title', 'Edit Penduduk Miskin HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.penduduk-miskin-hiv.index') }}">Penduduk Miskin HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Penduduk Miskin HIV</li>
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
                        <form action="{{ route('admin.penduduk-miskin-hiv.update', $pendudukMiskinHiv->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $pendudukMiskinHiv->kecamatan }}" required>
                            </div>

                            <!-- Penduduk Miskin -->
                            <div class="mb-3">
                                <label for="pdd_miskin" class="form-label">Penduduk Miskin</label>
                                <input type="text" class="form-control" id="pdd_miskin" name="pdd_miskin"
                                    value="{{ $pendudukMiskinHiv->pdd_miskin }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $pendudukMiskinHiv->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $pendudukMiskinHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
