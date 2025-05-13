<x-admin.layout>

    @section('title', 'Dashboard Jadwal')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Daftar Jadwal')</h2>
                    <a href="{{ route('schedule.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Atur Jadwal Baru
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
                                    <th class="px-3">Barber</th>
                                    <th class="px-3">Hari</th>
                                    <th class="px-3">Jam Mulai</th>
                                    <th class="px-3">Jam Selesai</th>
                                    <th class="px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schedules as $schedule)
                                    <tr>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                @if ($schedule->barber->photo)
                                                    <img src="{{ asset('storage/' . $schedule->barber->photo) }}"
                                                        class="rounded-circle me-3" width="40" height="40"
                                                        alt="{{ $schedule->barber->name }}">
                                                @else
                                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <span class="fw-medium">{{ $schedule->barber->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <span class="badge bg-info px-3 py-2">{{ $schedule->day }}</span>
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-clock me-2 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-clock me-2 text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <a href="{{ route('schedule.edit', $schedule) }}"
                                                    class="btn btn-warning btn-sm px-3" title="Edit">
                                                    edit
                                                </a>
                                                <form action="{{ route('schedule.destroy', $schedule) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm px-3"
                                                        title="Hapus">
                                                        hapus
                                                    </button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <p class="mb-0 fs-5">Belum ada jadwal yang diatur</p>
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
