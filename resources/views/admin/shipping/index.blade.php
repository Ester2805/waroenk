@extends('layouts.appAdmin')

@section('title', 'Opsi Pengiriman')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Kelola Opsi Pengiriman</h1>
        <a href="{{ route('admin.shipping-options.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-2"></i>Tambah Opsi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Estimasi Waktu</th>
                        <th class="text-end">Biaya Tambahan</th>
                        <th class="text-center">Status</th>
                        <th class="text-end" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($options as $option)
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
                                <a href="{{ route('admin.shipping-options.edit', $option) }}" class="btn btn-sm btn-outline-primary">
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
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada opsi pengiriman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
