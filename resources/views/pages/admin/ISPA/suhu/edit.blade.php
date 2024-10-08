@extends('layouts.app')

@section('title', 'Edit Data Penyakit ISPA')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.suhu-ispa.index') }}">Data Penyakit ISPA</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data Penyakit ISPA</li>
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
                        <form action="{{ route('admin.suhu-ispa.update', $suhuIspa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $suhuIspa->kecamatan }}" required>
                            </div>

                            <!-- Suhu -->
                            <div class="mb-3">
                                <label for="suhu" class="form-label">Suhu</label>
                                <input type="text" class="form-control" id="suhu" name="suhu"
                                    value="{{ $suhuIspa->suhu }}" required>
                            </div>

                            <!-- Kelas_suhu -->
                            <div class="mb-3">
                                <label for="kelas_suhu" class="form-label">Kelas Suhu</label>
                                <input type="text" class="form-control" id="kelas_suhu" name="kelas_suhu"
                                    value="{{ $suhuIspa->kelas_suhu }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $suhuIspa->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
