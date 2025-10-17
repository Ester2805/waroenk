@extends('layouts.appAdmin')

@section('title', 'Opsi Pengiriman')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Pengiriman</span>
                <h1>Kelola Opsi Pengiriman</h1>
                <p>Tambahkan atau perbarui metode pengiriman agar pelanggan bisa memilih opsi yang paling sesuai.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.shipping-options.create') }}" class="btn btn-accent">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Opsi
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($options->count() > 0)
        <div class="admin-table-card">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Estimasi Waktu</th>
                            <th class="text-end">Biaya Tambahan</th>
                            <th class="text-center">Status</th>
                            <th class="text-end" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                            <tr>
                                <td class="fw-semibold">{{ $option->name }}</td>
                                <td>{{ $option->estimated_time ?? '-' }}</td>
                                <td class="text-end">Rp{{ number_format($option->additional_cost, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($option->is_active)
                                        <span class="badge bg-success-subtle text-success-emphasis">Aktif</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.shipping-options.edit', $option) }}" class="btn btn-sm btn-outline-success me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.shipping-options.destroy', $option) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus opsi pengiriman ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="admin-empty">
            <div class="admin-empty-icon">🚚</div>
            <h4 class="fw-semibold mb-2">Belum ada opsi pengiriman</h4>
            <p class="text-muted mb-4">Tambahkan metode pengiriman agar pelanggan bisa memilih layanan yang tersedia.</p>
            <a href="{{ route('admin.shipping-options.create') }}" class="btn btn-accent">Tambah Opsi</a>
        </div>
    @endif
</div>
@endsection
