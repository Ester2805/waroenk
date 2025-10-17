@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<style>
    .profile-page {
        background: radial-gradient(circle at top left, rgba(102, 187, 106, 0.12), transparent 55%),
            radial-gradient(circle at bottom right, rgba(46, 125, 50, 0.12), transparent 55%),
            #f4f7fb;
        min-height: calc(100vh - 120px);
        padding-top: clamp(48px, 8vw, 80px);
        padding-bottom: clamp(64px, 12vw, 120px);
    }

    .profile-header-card {
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.08), rgba(102, 187, 106, 0.16));
        border-radius: 24px;
        padding: clamp(24px, 4vw, 40px);
        display: flex;
        flex-direction: column;
        gap: 18px;
        box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        margin-bottom: clamp(24px, 4vw, 36px);
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 24px;
        overflow: hidden;
        background: rgba(46, 125, 50, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        color: #2e7d32;
        box-shadow: inset 0 0 0 2px rgba(46, 125, 50, 0.15);
    }

    .profile-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        padding: clamp(28px, 5vw, 44px);
    }

    @media (max-width: 767.98px) {
        .profile-header-card {
            align-items: center;
            text-align: center;
        }
        .profile-card {
            padding: 24px;
        }
    }
</style>

<section class="profile-page">
    <div class="container-fluid" style="max-width:1180px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="profile-header-card">
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-4">
                <div class="profile-avatar">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <span class="badge bg-success text-white mb-2">{{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}</span>
                    <h2 class="fw-bold mb-1 text-dark">{{ $user->name }}</h2>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="profile-card">
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

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4 py-2">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
