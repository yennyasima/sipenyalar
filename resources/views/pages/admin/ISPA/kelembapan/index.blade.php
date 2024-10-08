@extends('layouts.app')

@section('title', 'Kelembapan ISPA')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelembapan ISPA</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Kelembapan ISPA</h4>
                            <a href="{{ route('admin.kelembapan-ispa.create') }}" class="btn btn-primary btn-sm">Tambah
                                Kelembapan ISPA</a>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Gambar</th>
                                        <th>Kecamatan</th>
                                        <th>Kelas</th>
                                        <th>Kelembapan</th>
                                        <th>Tanggal</th>
                                        <th>Operator</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelembapanIspa as $index => $item)
                                        <tr>
                                            <td>{{ ($kelembapanIspa->currentPage() - 1) * $kelembapanIspa->perPage() + $index + 1 }}
                                            </td>
                                            <td>
                                                @if ($item->gambar)
                                                    <img src="{{ asset('storage/kelembapanIspa/' . $item->gambar) }}"
                                                        alt="gambar"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->kecamatan }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->kelembapan }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->operator }}</td>
                                            <td>
                                                <a href="{{ route('admin.kelembapan-ispa.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.kelembapan-ispa.destroy', $item->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">Tidak ada kelembapan ISPA</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $kelembapanIspa->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function() {
            let alertElement = document.querySelector('.alert');
            if (alertElement) {
                alertElement.style.transition = "opacity 0.5s ease";
                alertElement.style.opacity = 0; // Menghilangkan dengan transisi
                setTimeout(() => {
                    alertElement.remove(); // Menghapus element dari DOM
                }, 1000); // Waktu transisi penghilangan (0.5 detik)
            }
        }, 3000); // 3 detik (3000 milidetik)
    </script>
@endpush
