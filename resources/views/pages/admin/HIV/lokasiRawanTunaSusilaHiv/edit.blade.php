@extends('layouts.app')

@section('title', 'Edit Lokasi Rawan Tuna Susila HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.lokasi-rawan-tuna-susila-hiv.index') }}">Lokasi Rawan
                        Tuna Susila HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Lokasi Rawan Tuna Susila HIV</li>
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
                        <form
                            action="{{ route('admin.lokasi-rawan-tuna-susila-hiv.update', $lokasiRawanTunaSusilaHiv->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $lokasiRawanTunaSusilaHiv->kecamatan }}" required>
                            </div>

                            <!-- lok_pros -->
                            <div class="mb-3">
                                <label for="lok_pros" class="form-label">Lokasi Pros</label>
                                <input type="text" class="form-control" id="lok_pros" name="lok_pros"
                                    value="{{ $lokasiRawanTunaSusilaHiv->lok_pros }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $lokasiRawanTunaSusilaHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
