<x-admin.layout>
    @section('title', 'Buat Booking Baru')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Buat Booking Baru')</h2>
                    <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('bookings.store') }}" class="row g-3">
                        @csrf
                        
                        <div class="col-md-12 mb-3">
                            <label for="barber_id" class="form-label fw-bold">
                                <i class="bi bi-person-badge me-1"></i> Pilih Barber
                            </label>
                            <select name="barber_id" id="barber_id" class="form-select @error('barber_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Barber --</option>
                                @foreach ($barbers as $barber)
                                    <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                        {{ $barber->name }} - {{ $barber->speciality }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barber_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        
                        <div class="col-md-6 mb-3">
                            <label for="booking_date" class="form-label fw-bold">
                                <i class="bi bi-calendar-date me-1"></i> Tanggal
                            </label>
                            <input type="date" name="booking_date" id="booking_date" 
                                  class="form-control @error('booking_date') is-invalid @enderror" 
                                  value="{{ old('booking_date', date('Y-m-d')) }}" required>
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="booking_time" class="form-label fw-bold">
                                <i class="bi bi-clock me-1"></i> Waktu
                            </label>
                            <input type="time" name="booking_time" id="booking_time" 
                                  class="form-control @error('booking_time') is-invalid @enderror" 
                                  value="{{ old('booking_time') }}" required>
                            @error('booking_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jam operasional: 08:00 - 20:00</small>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="note" class="form-label fw-bold">
                                <i class="bi bi-journal-text me-1"></i> Catatan (Opsional)
                            </label>
                            <textarea name="note" id="note" rows="3" 
                                     class="form-control @error('note') is-invalid @enderror" 
                                     placeholder="Masukkan catatan atau permintaan khusus">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Pastikan data yang dimasukkan sudah benar. Jadwal booking hanya dapat diubah atau dibatalkan minimal 2 jam sebelum waktu yang dijadwalkan.
                            </div>
                        </div>
                        
                        <div class="col-12 mt-4 d-flex justify-content-between">
                            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check"></i> Buat Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Optional: Jadwal yang sudah ada (untuk referensi) -->
            {{-- <div class="card shadow-sm mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-calendar-week"></i> Jadwal Hari Ini
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Barber</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($todayBookings ?? [] as $booking)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                                        <td>{{ $booking->barber->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Belum ada booking untuk hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>

        @push('scripts')
        <script>
            // Validasi tanggal dan waktu booking
            document.addEventListener('DOMContentLoaded', function() {
                const dateInput = document.getElementById('booking_date');
                const timeInput = document.getElementById('booking_time');
                
                // Set tanggal minimum hari ini
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0');
                const dd = String(today.getDate()).padStart(2, '0');
                const formattedToday = `${yyyy}-${mm}-${dd}`;
                
                dateInput.setAttribute('min', formattedToday);
                
                // Validasi waktu dalam jam operasional
                timeInput.addEventListener('change', function() {
                    const selectedTime = this.value;
                    const hour = parseInt(selectedTime.split(':')[0]);
                    
                    if (hour < 8 || hour >= 20) {
                        alert('Mohon pilih waktu antara jam 08:00 - 20:00');
                        this.value = '';
                    }
                });
            });
        </script>
        @endpush
    @endsection
</x-admin.layout>