@extends('layouts.app')

@section('title', 'Edit Wilayah Rentann HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.wilayah-rentan-hiv.index') }}">Wilayah Rentann HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Wilayah Rentann HIV</li>
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
                        <form action="{{ route('admin.wilayah-rentan-hiv.update', $wilayahRentanHiv->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $wilayahRentanHiv->kecamatan }}" required>
                            </div>

                            <!-- Nilai WR -->
                            <div class="mb-3">
                                <label for="nilai_wr" class="form-label">Nilai WR</label>
                                <input type="text" class="form-control" id="nilai_wr" name="nilai_wr"
                                    value="{{ $wilayahRentanHiv->nilai_wr }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $wilayahRentanHiv->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $wilayahRentanHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
