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
                        <form action="{{ route('admin.kepadatan-penduduk-dbd.update', $kepadatanPendudukDbd->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Remark -->
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                    value="{{ $kepadatanPendudukDbd->remark }}" required>
                            </div>

                            <!-- Kelurahan -->
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                    value="{{ $kepadatanPendudukDbd->kelurahan }}" required>
                            </div>

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $kepadatanPendudukDbd->kecamatan }}" required>
                            </div>

                            <!-- LK -->
                            <div class="mb-3">
                                <label for="LK" class="form-label">Laki - Laki</label>
                                <input type="number" class="form-control" id="LK" name="LK"
                                    value="{{ $kepadatanPendudukDbd->LK }}" required>
                            </div>

                            <!-- PR -->
                            <div class="mb-3">
                                <label for="PR" class="form-label">Prempuan</label>
                                <input type="number" class="form-control" id="PR" name="PR"
                                    value="{{ $kepadatanPendudukDbd->PR }}" required>
                            </div>

                            <!-- kepadatan -->
                            <div class="mb-3">
                                <label for="kepadatan" class="form-label">Kepadatan</label>
                                <input type="text" class="form-control" id="kepadatan" name="kepadatan"
                                    value="{{ $kepadatanPendudukDbd->kepadatan }}" required>
                            </div>

                            <!-- Tingkat Kasus -->
                            <div class="mb-3">
                                <label for="tingkat_ka" class="form-label">Tingkat Kasus</label>
                                <input type="text" class="form-control" id="tingkat_ka" name="tingkat_ka"
                                    value="{{ $kepadatanPendudukDbd->tingkat_ka }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $kepadatanPendudukDbd->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
