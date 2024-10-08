@extends('layouts.app')

@section('title', 'Edit Kepadatan Penduduk ISPA')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.data-penyakit-ispa.index') }}">Kepadatan Penduduk
                        ISPA</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Kepadatan Penduduk ISPA</li>
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
                        <form action="{{ route('admin.kepadatan-penduduk-ispa.update', $kepadatanPendudukIspa->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $kepadatanPendudukIspa->kecamatan }}" required>
                            </div>

                            <!-- kepdatan bps21 -->
                            <div class="mb-3">
                                <label for="kpdt_bps" class="form-label">kepdatan bps21</label>
                                <input type="number" class="form-control" id="kpdt_bps" name="kpdt_bps"
                                    value="{{ $kepadatanPendudukIspa->kpdt_bps }}" required>
                            </div>

                            <!-- Kelas Kepadatan -->
                            <div class="mb-3">
                                <label for="kelas_kpdt" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas_kpdt" name="kelas_kpdt"
                                    value="{{ $kepadatanPendudukIspa->kelas_kpdt }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $kepadatanPendudukIspa->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
