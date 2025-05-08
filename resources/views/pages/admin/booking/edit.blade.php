<x-admin.layout>
    @section('title', 'Edit Booking')

    @section('content')
        <div class="container">
            <h2>
            @section('content title', 'Edit Booking')
        </h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="barber_id">Barber</label>
                <select id="barber_id" name="barber_id" class="form-control" required>
                    <option value="">-- Pilih Barber --</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}"
                            {{ old('barber_id', $booking->barber_id) == $barber->id ? 'selected' : '' }}>
                            {{ $barber->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="booking_date">Tanggal</label>
                <input type="date" id="booking_date" name="booking_date" class="form-control"
                    value="{{ old('booking_date', $booking->booking_date) }}" required>
            </div>

            <div class="form-group">
                <label for="booking_time">Waktu</label>
                <input type="time" id="booking_time" name="booking_time" class="form-control"
                    value="{{ old('booking_time', $booking->booking_time) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $booking->status) == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="note">Catatan</label>
                <textarea id="note" name="note" class="form-control" rows="3">{{ old('note', $booking->note) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
</x-admin.layout>
