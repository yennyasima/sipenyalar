@extends('layouts.app')

@section('title', 'Edit Penduduk Pria Produktiv HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.penduduk-pria-usi-produktiv-hiv.index') }}">Penduduk Pria
                        Produktiv HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Penduduk Pria Produktiv HIV</li>
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
                            action="{{ route('admin.penduduk-pria-usi-produktiv-hiv.update', $penduduk_pria_usi_produktiv_hiv->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $penduduk_pria_usi_produktiv_hiv->kecamatan }}" required>
                            </div>

                            <!-- Penduduk Laki Laki Produktiv -->
                            <div class="mb-3">
                                <label for="pdd_lk_pro" class="form-label">Penduduk Laki Laki
                                    Produktiv</label>
                                <input type="text" class="form-control" id="pdd_lk_pro" name="pdd_lk_pro"
                                    value="{{ $penduduk_pria_usi_produktiv_hiv->pdd_lk_pro }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $penduduk_pria_usi_produktiv_hiv->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $penduduk_pria_usi_produktiv_hiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
