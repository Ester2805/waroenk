@extends('layouts.appAdmin')

@section('title', 'Profil Admin')

@section('content')
<div class="admin-page">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <span class="badge bg-success-subtle text-success fw-semibold mb-2">Akun Admin</span>
            <h1 class="h4 fw-bold text-dark mb-1">Profil {{ $user->name }}</h1>
            <p class="text-muted mb-0">Perbarui informasi akun admin untuk menjaga keamanan dan keakuratan data.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-4 overflow-hidden" style="width:72px; height:72px; background:rgba(46,125,50,0.12); display:flex; align-items:center; justify-content:center; font-size:28px; color:#2e7d32;">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <div class="fw-semibold text-dark">{{ $user->email }}</div>
                <small class="text-muted">Terakhir diperbarui {{ $user->updated_at?->diffForHumans() }}</small>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Nomor Handphone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Jenis Kelamin</label>
            <select name="gender" class="form-select">
                <option value="" {{ old('gender', $user->gender) === null ? 'selected' : '' }}>Pilih</option>
                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Tanggal Lahir</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Foto Profil</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
            <small class="text-muted d-block mt-1">Format JPG/PNG, ukuran maks 2MB.</small>
        </div>

        <div class="col-12 d-flex justify-content-end gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">Batal</a>
            <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
