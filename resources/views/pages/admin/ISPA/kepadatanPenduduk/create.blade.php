@extends('layouts.app')

@section('title', 'Create Kepadatan Penduduk ISPA')

@section('content')

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Kepadatan Penduduk ISPA</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Kepadatan Penduduk ISPA</li>
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
                        <form action="{{ route('admin.kepadatan-penduduk-ispa.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Unggah File JSON</label>
                                <input type="file" id="file" name="file" class="form-control dropify"
                                    accept=".geojson" required>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control dropify" id="gambar" name="gambar">
                            </div>

                            <div class="mb-3">
                                <label for="operator" class="form-label">Operator</label>
                                <input type="text" class="form-control" id="operator" name="operator">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Publish</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-1SGxRa3Y7VPehLRnM3e73LqFkzPz58hl+y8EgtjLYHP1m7zCkRZ2mUCZ9m9H0I2Gof9pC7GODdpmHrIu+OvJ8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify(); // Inisialisasi Dropify
    </script>
@endpush
