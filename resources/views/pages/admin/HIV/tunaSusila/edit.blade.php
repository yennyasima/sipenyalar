@extends('layouts.app')

@section('title', 'Edit Tuna Susila HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tuna-susila-hiv.index') }}">Tuna Susila HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Tuna Susila HIV</li>
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
                        <form action="{{ route('admin.tuna-susila-hiv.update', $tunaSusilaHiv->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $tunaSusilaHiv->kecamatan }}" required>
                            </div>

                            <!-- ha_tuna Susila -->
                            <div class="mb-3">
                                <label for="tn_susila" class="form-label">Tuna Susila</label>
                                <input type="text" class="form-control" id="tn_susila" name="tn_susila"
                                    value="{{ $tunaSusilaHiv->tn_susila }}" required>
                            </div>

                            <!-- kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas"
                                    value="{{ $tunaSusilaHiv->kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $tunaSusilaHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
