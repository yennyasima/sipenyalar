@extends('layouts.app')

@section('title', 'Edit Curah Hujan ISPA')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.curah-hujan-ispa.index') }}">Curah Hujan ISPA</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Curah Hujan ISPA</li>
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
                        <form action="{{ route('admin.curah-hujan-ispa.update', $curahHujanIspa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $curahHujanIspa->kecamatan }}" required>
                            </div>

                            <!-- Curah Hujan -->
                            <div class="mb-3">
                                <label for="ch" class="form-label">Curah Hujan</label>
                                <input type="text" class="form-control" id="ch" name="ch"
                                    value="{{ $curahHujanIspa->ch }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $curahHujanIspa->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $curahHujanIspa->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
