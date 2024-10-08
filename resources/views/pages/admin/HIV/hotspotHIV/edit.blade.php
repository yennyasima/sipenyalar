@extends('layouts.app')

@section('title', 'Edit Hotspot HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.hostpot-hiv.index') }}">Hotspot HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Hotspot HIV</li>
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
                        <form action="{{ route('admin.hostpot-hiv.update', $hostpotHiv->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Form fields here -->

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $hostpotHiv->kecamatan }}" required>
                            </div>

                            <!-- ha_kasus -->
                            <div class="mb-3">
                                <label for="ha_kasus" class="form-label">ha_kasus</label>
                                <input type="text" class="form-control" id="ha_kasus" name="ha_kasus"
                                    value="{{ $hostpotHiv->ha_kasus }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas_hiv" class="form-label">Kelas HIV</label>
                                <input type="text" class="form-control" id="kelas_hiv" name="kelas_hiv"
                                    value="{{ $hostpotHiv->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $hostpotHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
