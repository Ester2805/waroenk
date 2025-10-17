@php
    $status = $status ?? '';
    $classes = match($status) {
        'completed' => 'bg-success-subtle text-success-emphasis',
        'pending' => 'bg-warning-subtle text-warning-emphasis',
        'belum bayar' => 'bg-danger-subtle text-danger-emphasis',
        'diproses' => 'bg-primary-subtle text-primary-emphasis',
        'dikirim' => 'bg-info-subtle text-info-emphasis',
        default => 'bg-secondary-subtle text-secondary-emphasis',
    };

    $label = match($status) {
        'belum bayar' => 'Belum Bayar',
        'diproses' => 'Diproses',
        'dikirim' => 'Dikirim',
        default => str_replace('_', ' ', ucfirst($status)),
    };
@endphp

<span class="badge text-uppercase {{ $classes }}">{{ $label }}</span>
