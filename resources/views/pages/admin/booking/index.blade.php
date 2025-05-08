<x-admin.layout>

    @section('title', 'Dashboard Bookings')

    @section('content')
        <div class="container">
            <div class="container">
            <h2> @section('content title', 'Daftar Booking')</h2>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Tambah Booking</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Barber</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->barber->name }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            @php
                                $status = $booking->status;
                                $statusClass = 'badge-status';

                                if ($status === 'pending') {
                                    $statusClass .= ' text-status-pending';
                                } elseif ($status === 'confirmed') {
                                    $statusClass .= ' text-status-confirmed';
                                } elseif ($status === 'completed') {
                                    $statusClass .= ' text-status-completed';
                                } elseif ($status === 'cancelled') {
                                    $statusClass .= ' text-status-cancelled';
                                }
                            @endphp

                            <td><span class="{{ $statusClass }}">{{ ucfirst($status) }}</span></td>


                            <td>
                                <a href="{{ route('bookings.show', $booking) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


</x-admin.layout>
