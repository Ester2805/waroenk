@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<section class="py-5" style="background:#f4f6f8; min-height:80vh;">
    <div class="container" style="max-width:960px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-4 shadow-sm p-4 mb-4 d-flex flex-column flex-md-row align-items-md-center gap-4">
            <div class="position-relative">
                <div class="rounded-circle bg-success-subtle text-success-emphasis d-flex align-items-center justify-content-center" style="width:100px; height:100px; font-size:34px; overflow:hidden;">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
            </div>
            <div>
                <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <span class="badge bg-success-subtle text-success-emphasis">{{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}</span>
            </div>
        </div>

        <div class="bg-white rounded-4 shadow-sm p-4">
            <h5 class="fw-semibold mb-3">Informasi Profil</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor Handphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-select">
                        <option value="" {{ old('gender', $user->gender) === null ? 'selected' : '' }}>Pilih</option>
                        <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                        <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                    <small class="text-muted">Format JPG/PNG, ukuran maks 2MB.</small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
