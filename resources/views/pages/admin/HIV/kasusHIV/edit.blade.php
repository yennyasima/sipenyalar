@extends('layouts.app')

@section('title', 'Edit Kasus HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kasus-hiv.index') }}">Kasus HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Kasus HIV</li>
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
                        <form action="{{ route('admin.kasus-hiv.update', $kasusHiv->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $kasusHiv->kecamatan }}" required>
                            </div>

                            <!-- ha_kasus -->
                            <div class="mb-3">
                                <label for="ha_kasus" class="form-label">ha_kasus</label>
                                <input type="text" class="form-control" id="ha_kasus" name="ha_kasus"
                                    value="{{ $kasusHiv->ha_kasus }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas_hiv" class="form-label">Kelas HIV</label>
                                <input type="text" class="form-control" id="kelas_hiv" name="kelas_hiv"
                                    value="{{ $kasusHiv->kelas_hiv }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $kasusHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
