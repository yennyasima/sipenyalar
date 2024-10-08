@extends('layouts.app')

@section('title', 'Edit Faskek PDP HIV')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.faskes-pdp-hiv.index') }}">Faskek PDP HIV</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Faskek PDP HIV</li>
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
                        <form action="{{ route('admin.faskes-pdp-hiv.update', $faskesPdpHiv->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $faskesPdpHiv->kecamatan }}" required>
                            </div>

                            <!-- faskes_pdp -->
                            <div class="mb-3">
                                <label for="faskes_pdp" class="form-label">Faskek PDP</label>
                                <input type="text" class="form-control" id="faskes_pdp" name="faskes_pdp"
                                    value="{{ $faskesPdpHiv->faskes_pdp }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="geometry" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry" name="geometry">{{ $faskesPdpHiv->geometry }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
