@extends('layouts.appAdmin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold text-success mb-1">Kelola Pengguna</h1>
            <p class="text-muted mb-0">Lihat pengguna aktif, cari akun, dan ubah peran mereka.</p>
        </div>
        <form method="GET" class="d-flex gap-2">
            <input
                type="text"
                name="q"
                value="{{ $search }}"
                class="form-control"
                placeholder="Cari nama atau email"
            >
            <select name="role" class="form-select">
                <option value="">Semua Peran</option>
                <option value="user" {{ $role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <button class="btn btn-success" type="submit">Filter</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Total Pengguna</p>
                    <h4 class="fw-bold mb-0">{{ number_format($counts['total']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Admin</p>
                    <h4 class="fw-bold mb-0">{{ number_format($counts['admin']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">User Biasa</p>
                    <h4 class="fw-bold mb-0">{{ number_format($counts['user']) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'bg-success-subtle text-success-emphasis' : 'bg-primary-subtle text-primary-emphasis' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="d-flex justify-content-end gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-select form-select-sm w-auto">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button class="btn btn-sm btn-outline-success" type="submit">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Tidak ada pengguna yang cocok dengan filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
