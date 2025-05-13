<x-admin.layout>

    @section('title', 'Dashboard Bookings')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Daftar Booking')</h2>
                    <a href="{{ route('bookings.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Tambah Booking
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3">Customer</th>
                                    <th class="px-3">Barber</th>
                                    <th class="px-3">Tanggal</th>
                                    <th class="px-3">Waktu</th>
                                    <th class="px-3">Status</th>
                                    <th class="px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                @if ($booking->user->photo)
                                                    <img src="{{ asset('storage/' . $booking->user->photo) }}"
                                                        class="rounded-circle me-3" width="40" height="40"
                                                        alt="{{ $booking->user->name }}">
                                                @else
                                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <span class="fw-medium">{{ $booking->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                @if ($booking->barber->photo)
                                                    <img src="{{ asset('storage/' . $booking->barber->photo) }}"
                                                        class="rounded-circle me-3" width="40" height="40"
                                                        alt="{{ $booking->barber->name }}">
                                                @else
                                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <span class="fw-medium">{{ $booking->barber->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-calendar me-2 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-clock me-2 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            @php
                                                $statusClass = '';
                                                switch ($booking->status) {
                                                    case 'pending':
                                                        $statusClass = 'bg-warning';
                                                        break;
                                                    case 'confirmed':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'completed':
                                                        $statusClass = 'bg-info';
                                                        break;
                                                    case 'cancelled':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                }
                                            @endphp
                                            <span
                                                class="badge {{ $statusClass }} px-3 py-2">{{ ucfirst($booking->status) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking) }}"
                                                class="btn btn-info btn-sm px-3" title="Detail">
                                                details
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking) }}"
                                                class="btn btn-warning btn-sm px-3" title="Edit">
                                                edit
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-3" title="Hapus">
                                                    delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <p class="mb-0 fs-5">Belum ada booking yang dibuat</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</x-admin.layout>
